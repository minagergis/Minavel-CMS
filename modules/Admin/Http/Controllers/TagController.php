<?php namespace Modules\Admin\Http\Controllers;


use Modules\Admin\Models\Language;
use Modules\Admin\Models\Tag;
use Modules\Admin\Models\TagTranslation;

use Modules\Admin\Http\Requests\TagRequest;
use Modules\Admin\Http\Requests\DeleteRequest;

class TagController extends AdminController {
	
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

    public function getAddTag()
    {
        $this->checkLang();

        $lang = $this->current_lang;
        $id   = e(\Request::get('id'));

        if($lang && $id ) {

            $tag = Tag::whereHas('translations', function ($query) use($lang, $id) {
                $query->where('locale', $lang)->where('tag_id', $id);
            })->first();

            if(count($tag) > 0) {
                return redirect()->route('admin.tags.edit.get', [$id, "lang=$lang" ]);
            }

            $tag = Tag::find($id);
            $action = 'add_translate';

        } else {
            $action = 'add';
        }

        $language           = $this->language;
        $current_lang       = $this->current_lang;
        $language_icon      = $this->language_icon;
        $language_available = $this->language_available;
        $categories = TagTranslation::join('tags', 'tags.id', '=', 'tags_translations.tag_id')
            ->select([
                'tags_translations.name as name',
                'tags_translations.locale as locale',
                'tags.id as tag_id',
                'tags.slug as slug',
            ])
            ->where('tags_translations.locale', '=', $current_lang)
            ->get();


        return view('admin::sections.tags.create_edit', compact('language', 'language_icon', 'language_available', 'current_lang', 'tag', 'action', 'categories'));
    }


    /**
     * @param TagRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAddTag(TagRequest $request)
    {
        $current_lang = $request->get('current_lang');
        $id = intval($request->get('id'));

        $return = ($id != null) ? $this->processForm($request, $id): $this->processForm($request);

        if ($return > 0) {
            return redirect()->route('admin.tags.edit.get', [$return, "lang=$current_lang" ]);
        } else {
            return view('admin::errors.failed');
            //\Session::flash('failed', 'Failed!');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEditTag($id)
    {

        $this->checkLang();

        $language = $this->language;
        $current_lang = $this->current_lang;
        $tag = Tag::find($id);

        if(!$tag) {
            return view('admin::errors.item_not_found');
        }

        // check if not found record for this locale
        $tag_translate = $tag->translate($current_lang);

        if( !count($tag_translate) > 0) {
            return view('admin::errors.item_not_found');
        }
        $action = 'edit';

        $language           = $this->language;
        $current_lang       = $this->current_lang;
        $language_icon      = $this->language_icon;
        $language_available = $this->language_available;
        $categories = TagTranslation::join('tags', 'tags.id', '=', 'tags_translations.tag_id')
            ->select([
                'tags_translations.name as name',
                'tags_translations.locale as locale',
                'tags.id as tag_id',
                'tags.slug as slug',
            ])
            ->where('tags_translations.locale', '=', $current_lang)
            ->get();


        return view('admin::sections.tags.create_edit', compact('language', 'language_icon', 'language_available', 'current_lang', 'tag', 'action', 'categories'));

    }


    public function postEditTag(TagRequest $request ,$id)
    {
        if($this->processForm($request, $id)) {
            \Session::flash('success', 'Successfully updated.');
        } else {
            \Session::flash('failed', 'Failed!');
        }
        return redirect()->back();
    }

    public function getDeleteTag($id) {
        $tag = Tag::find($id);

        if(!count($tag) > 0) {
            return view('admin::errors.item_not_found');
        }
        return view('admin::sections.tags.delete', compact('tag'));
    }


    public function postDeleteTag(DeleteRequest $request, $id) {

        if(Tag::find($request->id)->delete()) {
            return redirect()->route('admin.tags.get');
        }
        return 'Failed';
    }


    /**
     * @param $request
     * @param null $id
     * @return bool|mixed
     */
    protected function processForm($request , $id = null )
    {
        $tag = ($id == null) ? new Tag : Tag::find($id);

        //$tag->slug = getUniqueSlug($tag, $request->get('slug'));
        $tag->slug = $request->has('slug') ? str_slug($request->get('slug')) : str_slug($request->get('name')) ;

        $tag->save();
        $locale = trim($request->get('locale')) ;
        $tag->translateOrNew($locale)->name = trim($request->get('name')) ;
        $tag->translateOrNew($locale)->description = trim($request->get('description')) ;

        if($tag->save()) {
            return $tag->id;
        } else {
            return false;
        }

    }


    public function getTagData()
    {

        $lang  = \Session::get('lang');

        $categories = TagTranslation::join('tags', 'tags.id', '=', 'tags_translations.tag_id')
            ->select([
                'tags_translations.name as name',
                'tags_translations.locale as locale',
                'tags.id as tag_id',
                'tags.slug as slug',
            ])
            ->where(function($query) use($lang)
            {
                if($lang == 'all') {
                    $query->whereIn('tags_translations.locale', $this->language_available);
                } else {
                    $query->where('tags_translations.locale', $lang);
                }

            })
            ->orderby('tags.id', 'DESC');


        $datatables =  app('datatables')->of($categories);

        foreach ($this->language_available as $l) {
            $datatables->addColumn($l, function ($tag) use ($l) {

                $c = TagTranslation::where('tag_id', $tag->tag_id)
                    ->where('locale', $l)
                    ->get();
                if(count($c) > 0){
                    if($tag->locale == $l) {
                        $icon = 'ok';
                    } else {
                        $icon = 'pencil';
                    }
                    return '<a href="'. route('admin.tags.edit.get', [$tag->tag_id, "&lang=$l"]) .'"><span class="glyphicon glyphicon-'. $icon .'"></span></a>';
                } else {
                    return '<a href="'. route('admin.tags.add.get', "id=$tag->tag_id&lang=$l") .'"><span class="glyphicon glyphicon-plus"></span></a>';
                }

            });
        }

        $datatables ->addColumn('action', function ($tag) {
            return '<a class="btn btn-danger btn-sm" href="'. route('admin.tags.delete.post' , $tag->tag_id) .'"><i class="fa fa-trash"></i>delete</a>';
        });
        return  $datatables->make(true);

    }

    /**
     * Check if url have lang param.
     *
     * @return void
     */
    protected function checkLang()
    {
        $this->current_lang = \Request::get('lang') !== null ? e(\Request::get('lang')) : 'en';
        if(!in_array($this->current_lang, $this->language_available)) {
            abort(404);
        }
    }
}