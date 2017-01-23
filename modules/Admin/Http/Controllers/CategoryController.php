<?php namespace Modules\Admin\Http\Controllers;

use Modules\Admin\Http\Requests\CategoryRequest;
use Modules\Admin\Http\Requests\DeleteRequest;
use Modules\Admin\Models\Category;
use Modules\Admin\Models\CategoryTranslation;
use Modules\Admin\Models\Language;

class CategoryController extends AdminController
{

    /**
     * @var
     */
    private $current_lang, $language, $language_available, $language_icon;

    public function __construct()
    {
        parent::__construct();

        $this->language = Language::select(['name', 'locale', 'icon'])->get();
        $this->language_available = array_pluck($this->language, 'locale');
        $this->language_icon = array_pluck($this->language, 'icon');
    }

    public function getAddCategory()
    {
        $this->checkLang();

        $lang = $this->current_lang;
        $id = e(\Request::get('id'));

        if ($lang && $id) {

            $category = Category::find($id);

            if (count($category) > 0) {
                $category_translate = $category->translate($lang);

                if (count($category_translate) > 0) {
                    return redirect()->route('admin.category.edit.get', [$id, "lang=$lang"]);
                }

                $action = 'add_translate';
            }

        } else {
            $action = 'add';
        }

        $language = $this->language;
        $current_lang = $this->current_lang;
        $language_icon = $this->language_icon;
        $language_available = $this->language_available;

        return view('admin::sections.category.create_edit', compact('language', 'language_icon', 'language_available', 'current_lang', 'action', 'categories'));
    }

    protected function checkLang()
    {
        $this->current_lang = \Request::get('lang') !== null ? e(\Request::get('lang')) : 'en';
        if (!in_array($this->current_lang, $this->language_available)) {
            abort(404);
        }
    }

    public function postAddCategory(CategoryRequest $request)
    {
        $id = intval($request->get('id'));

        $return = ($id != null) ? $this->processForm($request, $id) : $this->processForm($request);

        if ($return > 0) {
            return redirect()->route('admin.category.edit.get', [$return, "lang=" . $request->get('locale')]);
        } else {
            return view('admin::errors.failed');
            //\Session::flash('failed', 'Failed!');
        }
    }

    protected function processForm($request, $id = null)
    {
        $category = ($id == null) ? new Category : Category::find($id);

        //getUniqueSlug($category, $request->get('slug'));
        $category->type = trim($request->get('type'));
        $category->save();
        $locale = trim($request->get('locale'));
        $category->translateOrNew($locale)->slug = $request->has('slug') ? str_replace(' ', '-', $request->get('slug')) : str_replace(' ', '-', $request->get('name'));
        $category->translateOrNew($locale)->name = trim($request->get('name'));
        $category->translateOrNew($locale)->description = trim($request->get('description'));

        return $category->save() ? $category->id : false;

    }

    public function getEditCategory($id)
    {

        $this->checkLang();

        $language = $this->language;
        $current_lang = $this->current_lang;
        $category = Category::find($id);

        if (!$category) {
            return view('admin::errors.item_not_found');
        }

        // check if not found record for this locale
        $category_translate = $category->translate($current_lang);

        if (!count($category_translate) > 0) {
            return view('admin::errors.item_not_found');
        }
        $action = 'edit';

        $language = $this->language;
        $current_lang = $this->current_lang;
        $language_icon = $this->language_icon;
        $language_available = $this->language_available;


        return view('admin::sections.category.create_edit', compact('language', 'language_icon', 'language_available', 'current_lang', 'category', 'action'));

        //return view('admin::sections.category.create_edit', compact('category', 'language', 'language_icon', 'language_available', 'current_lang', 'action'));

    }

    public function postEditCategory(CategoryRequest $request, $id)
    {
        if ($this->processForm($request, $id)) {
            \Session::flash('success', 'Successfully updated.');
        } else {
            \Session::flash('failed', 'Failed!');
        }
        return redirect()->back();
    }

    public function getDeleteCategory($id)
    {
        $category = Category::find($id);

        if (!count($category) > 0) {
            return view('admin::errors.item_not_found');
        }
        return view('admin::sections.category.delete', compact('category'));
    }

    public function postDeleteCategory(DeleteRequest $request, $id)
    {

        if (Category::find($request->id)->delete()) {
            return redirect()->route('admin.category.get');
        }
        return 'Failed';
    }

    public function getCategoryArticles()
    {
        $lang = \Session::get('lang');

        $articles = CategoryTranslation::join('category', 'category.id', '=', 'category_translations.category_id')
            ->select([
                'category_translations.name as name',
                'category_translations.locale as locale',
                'category.id as category_id',
                'category_translations.slug as slug',
            ])
            ->where(function ($query) use ($lang) {
                if ($lang == 'all') {
                    $query->whereIn('category_translations.locale', $this->language_available);
                } else {
                    $query->where('category_translations.locale', $lang);
                }

            })
            ->where('category.type', 'articles')
            ->orderby('category.id', 'DESC');


        $datatables = app('datatables')->of($articles);

        foreach ($this->language_available as $l) {
            $datatables->addColumn($l, function ($articles) use ($l) {

                $c = CategoryTranslation::where('category_id', $articles->category_id)
                    ->where('locale', $l)
                    ->get();
                if (count($c) > 0) {
                    if ($articles->locale == $l) {
                        $icon = 'ok';
                    } else {
                        $icon = 'pencil';
                    }
                    return '<a href="' . route('admin.category.edit.get', [$articles->category_id, "&lang=$l"]) . '"><span class="glyphicon glyphicon-' . $icon . '"></span></a>';
                } else {
                    return '<a href="' . route('admin.category.add.get', "id=$articles->category_id&lang=$l") . '"><span class="glyphicon glyphicon-plus"></span></a>';
                }

            });
        }

        $datatables->addColumn('action', function ($articles) {
            return '<a class="btn btn-danger btn-sm" href="' . route('admin.category.delete.post', $articles->category_id) . '"><i class="fa fa-trash"></i>delete</a>';
        });
        return $datatables->make(true);

    }

    public function getCategoryCases()
    {
        $lang = \Session::get('lang');

        $articles = CategoryTranslation::join('category', 'category.id', '=', 'category_translations.category_id')
            ->select([
                'category_translations.name as name',
                'category_translations.locale as locale',
                'category.id as category_id',
                'category_translations.slug as slug',
            ])
            ->where(function ($query) use ($lang) {
                if ($lang == 'all') {
                    $query->whereIn('category_translations.locale', $this->language_available);
                } else {
                    $query->where('category_translations.locale', $lang);
                }

            })
            ->where('category.type', 'cases')
            ->orderby('category.id', 'DESC');


        $datatables = app('datatables')->of($articles);

        foreach ($this->language_available as $l) {
            $datatables->addColumn($l, function ($articles) use ($l) {

                $c = CategoryTranslation::where('category_id', $articles->category_id)
                    ->where('locale', $l)
                    ->get();
                if (count($c) > 0) {
                    if ($articles->locale == $l) {
                        $icon = 'ok';
                    } else {
                        $icon = 'pencil';
                    }
                    return '<a href="' . route('admin.category.edit.get', [$articles->category_id, "&lang=$l"]) . '"><span class="glyphicon glyphicon-' . $icon . '"></span></a>';
                } else {
                    return '<a href="' . route('admin.category.add.get', "id=$articles->category_id&lang=$l") . '"><span class="glyphicon glyphicon-plus"></span></a>';
                }

            });
        }

        $datatables->addColumn('action', function ($articles) {
            return '<a class="btn btn-danger btn-sm" href="' . route('admin.category.delete.post', $articles->category_id) . '"><i class="fa fa-trash"></i>delete</a>';
        });
        return $datatables->make(true);

    }

    public function getCategoryDownload()
    {
        $lang = \Session::get('lang');

        $articles = CategoryTranslation::join('category', 'category.id', '=', 'category_translations.category_id')
            ->select([
                'category_translations.name as name',
                'category_translations.locale as locale',
                'category.id as category_id',
                'category_translations.slug as slug',
            ])
            ->where(function ($query) use ($lang) {
                if ($lang == 'all') {
                    $query->whereIn('category_translations.locale', $this->language_available);
                } else {
                    $query->where('category_translations.locale', $lang);
                }

            })
            ->where('category.type', 'downloads')
            ->orderby('category.id', 'DESC');


        $datatables = app('datatables')->of($articles);

        foreach ($this->language_available as $l) {
            $datatables->addColumn($l, function ($articles) use ($l) {

                $c = CategoryTranslation::where('category_id', $articles->category_id)
                    ->where('locale', $l)
                    ->get();
                if (count($c) > 0) {
                    if ($articles->locale == $l) {
                        $icon = 'ok';
                    } else {
                        $icon = 'pencil';
                    }
                    return '<a href="' . route('admin.category.edit.get', [$articles->category_id, "&lang=$l"]) . '"><span class="glyphicon glyphicon-' . $icon . '"></span></a>';
                } else {
                    return '<a href="' . route('admin.category.add.get', "id=$articles->category_id&lang=$l") . '"><span class="glyphicon glyphicon-plus"></span></a>';
                }

            });
        }

        $datatables->addColumn('action', function ($articles) {
            return '<a class="btn btn-danger btn-sm" href="' . route('admin.category.delete.post', $articles->category_id) . '"><i class="fa fa-trash"></i>delete</a>';
        });
        return $datatables->make(true);

    }

}