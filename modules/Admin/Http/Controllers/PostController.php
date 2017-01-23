<?php namespace Modules\Admin\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Input;
use Modules\Admin\Http\Requests\DeleteRequest;
use Modules\Admin\Http\Requests\PostRequest;
use Modules\Admin\Models\CategoryTranslation;
use Modules\Admin\Models\Language;
use Modules\Admin\Models\MultipleMedia;
use Modules\Admin\Models\Post;
use Modules\Admin\Models\PostCategory;
use Modules\Admin\Models\PostTranslation;
use Modules\Admin\Models\Seo;

class PostController extends AdminController
{

    /**
     * @var
     */
    private $post, $post_translations, $language, $post_type, $current_lang, $language_available, $language_icon;
    private $post_type_array = ['Article', 'Page', 'Slider', 'Download', 'Team', 'Testimonial', 'Case', 'Topic'];

    public function __construct()
    {
        parent::__construct();
        $this->post_type = \Request::get('post_type');
        if (!in_array($this->post_type, $this->post_type_array)) {
            return view('admin::errors.invalid_post_type');
        }
        $this->language = Language::select(['name', 'locale', 'icon'])->get();
        $this->language_available = array_pluck($this->language, 'locale');
        $this->language_icon = array_pluck($this->language, 'icon');

        $this->checkLang();
    }

    protected function checkLang()
    {
        $this->current_lang = \Request::get('lang') !== null ? e(\Request::get('lang')) : 'en';
        if (!in_array($this->current_lang, $this->language_available)) {
            abort(404);
        }
    }

    public function getPosts()
    {
        $data['post_type'] = $this->post_type;
        $data['language_icon'] = $this->language_icon;
        $data['language_available'] = $this->language_available;
        return view('admin::sections.posts.index', $data);
    }

    public function getAddPost()
    {

        $lang = $this->current_lang;
        $id = e(\Request::get('id'));

        if ($lang && $id) {

            $post = Post::find($id);

            if (count($post) > 0) {
                $post_translate = $post->translate($lang);

                if (count($post_translate) > 0) {
                    return redirect()->route('admin.post.edit.get', [$id, "lang=$lang"]);
                }

                $action = 'add_translate';
            }

        } else {
            $action = 'add';
        }

        $current_lang = $this->current_lang;
        $current_lang = $current_lang !== 'all' ? $current_lang : 'ar';
        $categorytype = $this->getCategoryType($this->post_type);
        $categories = CategoryTranslation::join('category', 'category.id', '=', 'category_translations.category_id')
            ->select([
                'category_translations.name as name',
                'category_translations.locale as locale',
                'category.id as id',
                'category_translations.slug as slug',
            ])
            ->where('category_translations.locale', '=', $current_lang)
            ->where('category.type', '=', $categorytype)
            ->get();
        $post_type = $this->post_type;
        $language_icon = $this->language_icon;
        $language_available = $this->language_available;
        $language = $this->language;
        $current_lang = $this->current_lang;
        $users = User::all();

        return view('admin::sections.posts.create_edit', compact('post', 'post_type', 'language_icon', 'language_available', 'categories', 'language', 'current_lang', 'post', 'action', 'users'));
    }

    protected function getCategoryType($post_type)
    {
        $array = ['Article' => 'articles', 'Case' => 'cases', 'Download' => 'downloads'];
        foreach ($array as $key => $value) {
            if ($key == $post_type) {
                return $value;
            }
        }

    }

    public function postAddPost(PostRequest $request)
    {

        $id = intval($request->get('id'));

        $return = ($id != null) ? $this->processForm($request, $id) : $this->processForm($request);

        if ($return > 0) {
            return redirect()->route('admin.posts.edit.get', [$return, 'post_type=' . $this->post_type, 'lang=' . $request->get('locale')]);

        } else {
            return view('admin::errors.failed');
        }
    }

    protected function processForm($request, $id = null)
    {
        $post = ($id == null) ? new Post : Post::find($id);

        $post->post_type = $this->post_type;
        $post->media_id = $request->has('media_id') ? $request->media_id : null;

        if ($request->get('publish') !== null) {
            $post->post_status = 'publish';
        } elseif ($request->get('draft') !== null) {
            $post->post_status = 'draft';
        } else {
            $post->post_status = 'trash';
        }

        $post->save();

        $locale = trim($request->get('locale'));
        $post->translateOrNew($locale)->slug = $request->has('slug') ? str_replace(' ', '-', $request->get('slug')) : str_replace(' ', '-', $request->get('post_title'));
        $post->translateOrNew($locale)->post_title = trim($request->get('post_title'));
        $post->translateOrNew($locale)->post_excerpt = trim($request->get('post_excerpt'));
        $post->translateOrNew($locale)->post_content = trim($request->get('post_content'));
        $post->translateOrNew($locale)->post_author = $request->get('author');
        //$post->translateOrNew($locale)->comment_status = 'open' ;

        /*============== Extra section Start ===============*/
        if ($request->has('extra')) {
            $data = [];
            foreach ($request->get('extra') as $key => $extra) {
                $data[$key] = $extra;
            }
            $post->extra = json_encode($data);
        }
        /*============== Extra section End ===============*/


        if ($post->save()) {

            /*============== Tags section Start ===============*/
            if ($request->has('tags')) {
                /****************************************
                 * first check if there were tags before *
                 * if there then use retag               *
                 * if there no then use tag              *
                 *****************************************/
                if (count($post->tagNames()) > 0) {
                    $post->retag(explode(',', $request->tags));
                } else {
                    $post->tag(explode(',', $request->tags));
                }
            }

            if (!$request->has('tags') && (count($post->tagNames()) > 0)) {
                $post->untag(); // remove all tags
            }
            /*============== Tags section End ===============*/
            /*=============== Meta Tags Start==================*/
            if ($request->get('MetaTitle') != null && $request->get('MetaDesc') != null && $request->get('MetaTags') != null) {
                $MetaArray = ['title' => $request->get('MetaTitle'), 'desc' => $request->get('MetaDesc'), 'tags' => $request->get('MetaTags'), 'item_id' => $post->id, 'item_type' => 'post', 'locale' => $locale];
                $SEO_POST = Seo::where('item_id', $id)->where('item_type', $this->post_type)->where('locale', $locale)->first();

                if ($SEO_POST) {
                    Seo::where('item_id', $id)->where('item_type', 'post')->where('locale', $locale)->update($MetaArray);
                } else {
                    Seo::insert($MetaArray);
                }
            }


            /*=============== Meta Tags End==================*/

            /*=========== Category Section Start ============*/
            PostCategory::where('post_id', $post->id)->delete();
            if (Input::has('category') && count($request->get('category'))) {
                $arr = [];
                foreach ($request->get('category') as $category_id) {
                    $arr[] = ['post_id' => $post->id, 'category_id' => $category_id];
                }

                if (count($arr) > 0) {
                    PostCategory::insert($arr);
                }
            }
            /*=========== Category Section End   ============*/

            /*=========== Multiple Section Start ============*/

            if ($request->has('multiple_media_id')) {
                $arr2 = [];
                foreach ($request->multiple_media_id as $media_id) {
                    if (intval($media_id)) {
                        $arr2[] = ['post_id' => $post->id, 'media_id' => $media_id];
                    }
                }

                if (count($arr2) > 0) {
                    MultipleMedia::where('post_id', $post->id)->delete();
                    MultipleMedia::insert($arr2);
                }
            }

            return $post->id;
        } else {
            return false;
        }

    }

    public function getEditPost($id)
    {
        $language = $this->language;
        $current_lang = $this->current_lang;
        $post = Post::find($id);

        if (!$post) {
            return view('admin::errors.item_not_found');
        }

        // check if not found record for this locale
        $post_translate = $post->translate($current_lang);

        if (!count($post_translate) > 0) {
            return view('admin::errors.item_not_found');
        }

        $action = 'edit';

        $categories_ids = Post::join('post_category', 'posts.id', '=', 'post_category.post_id')
            ->select(['post_category.category_id as id'])
            ->where('post_id', $id)
            ->lists('id')
            ->toArray();

        $category_type = $this->getCategoryType($this->post_type);
        $current_lang = $this->current_lang;
        $current_lang = $current_lang !== 'all' ? $current_lang : 'ar';
        $categories = CategoryTranslation::join('category', 'category.id', '=', 'category_translations.category_id')
            ->where('category_translations.locale', $current_lang)
            ->where('category.type', '=', $category_type)
            ->get();


        $post_type = $this->post_type;
        $seo = Seo::where('item_id', $id)->where('item_type', 'post')->where('locale', $current_lang)->first();
        if (isset($seo)) {
            $post->MetaTags = $seo->tags;
            $post->MetaTitle = $seo->title;
            $post->MetaDesc = $seo->desc;
        }


        $multiple_media = MultipleMedia::join('media', 'media.id', '=', 'multiple_media.media_id')
            ->where('post_id', $id)->get();

        $users = User::all();
        return view('admin::sections.posts.create_edit', compact('post_type', 'post', 'categories', 'categories_ids', 'language_icon', 'language_available', 'language', 'current_lang', 'action', 'multiple_media', 'users'));

    }

    public function postEditPost(PostRequest $request, $id)
    {
        if ($this->processForm($request, $id)) {
            \Session::flash('success', 'Successfully updated.');
        } else {
            \Session::flash('failed', 'Failed!');
        }
        return redirect()->back();
    }

    public function getDeletePost($id)
    {
        $post = Post::find($id);
        $post_type = $this->post_type;

        if (!count($post) > 0) {
            return view('admin::errors.item_not_found');
        }
        return view('admin::sections.posts.delete', compact('post', 'post_type'));
    }

    public function postDeletePost(DeleteRequest $request, $id)
    {
        $post_type = $this->post_type;
        if (Post::find($request->id)->delete()) {
            Seo::where('item_id', $request->id)->where('item_type',$post_type)->delete();
            return redirect()->route('admin.posts.get', 'post_type=' . $post_type);
        }
        return view('admin::errors.failed');
    }

    public function getPostsData($post_status = 'publish')
    {

        $lang = \Session::get('lang');
        $post_type = $this->post_type;
        $languages = $this->language_available;

        $posts = PostTranslation::join('posts', 'posts.id', '=', 'posts_translations.post_id')
            ->where('posts.post_type', $post_type)
            ->where('posts.post_status', $post_status)
            ->select([
                'posts_translations.post_title as post_title',
                'posts_translations.locale as locale',
                'posts_translations.post_id as post_id',
                'posts.post_type as post_type',
                'posts_translations.slug as slug',
                'posts.id as id',
            ])
            ->where(function ($query) use ($lang) {
                if ($lang == 'all') {
                    $query->whereIn('posts_translations.locale', $this->language_available);
                } else {
                    $query->where('posts_translations.locale', $lang);
                }

            })
            ->orderby('posts.id', 'DESC');

        $datatables = app('datatables')->of($posts);

        foreach ($this->language_available as $l) {
            $datatables->addColumn($l, function ($post) use ($l) {

                $p = PostTranslation::where('post_id', $post->post_id)
                    ->where('locale', $l)
                    ->get();

                if (count($p) > 0) {
                    if ($post->locale == $l) {
                        $icon = 'ok';
                    } else {
                        $icon = 'pencil';
                    }
                    return '<a target="_blank" href="' . route('admin.posts.edit.get', [$post->id, 'post_type=' . $post->post_type, 'lang=' . $l]) . '"><span class="glyphicon glyphicon-' . $icon . '"></span></a>';
                } else {
                    return '<a target="_blank" href="' . route('admin.posts.add.get', ['id=' . $post->id, 'post_type=' . $post->post_type, 'lang=' . $l]) . '"><span class="glyphicon glyphicon-plus"></span></a>';
                }
            });
        }

        $datatables->editColumn('post_title', function ($post) {
            return '<a href="' . route('admin.posts.edit.get', [$post->id, 'post_type=' . $post->post_type]) . '"><i class="fa fa-edit"></i> &nbsp;' . $post->post_title . '</a>';
        });

        $datatables->addColumn('action', function ($post) {
            return '<a class="btn btn-danger btn-sm" href="' . route('admin.posts.delete.post', [$post->id, 'post_type=' . $post->post_type]) . '"><i class="fa fa-trash"></i>delete</a>';
        });

        return $datatables->make(true);

    }

    protected function checkPostType($post_type)
    {
        if (!in_array($post_type, $this->post_type_array)) {
            return view('admin::errors.invalid_post_type');
        }
        return true;
    }
}