<?php namespace Modules\Admin\Http\Controllers;

use Modules\Admin\Http\Requests\WebInfoRequest;
use Modules\Admin\Http\Requests\DeleteRequest;
use Modules\Admin\Models\WebInfo;
use Modules\Admin\Models\Language;

class WebInfoController extends AdminController
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

    protected function checkLang()
    {
        $this->current_lang = \Request::get('lang') !== null ? e(\Request::get('lang')) : 'en';
        if (!in_array($this->current_lang, $this->language_available)) {
            abort(404);
        }
    }

    protected function processForm($request, $id = null)
    {
        $webinfo = ($id == null) ? new WebInfo : WebInfo::find($id);
        if ($request->has('extras')) {
            $data = [];
            foreach ($request->get('extras') as $key => $extra) {
                $data[$key] = $extra;
            }
            $webinfo->extras = json_encode($data);
        }

        if ($request->has('socials')) {
            $socialdata = [];
            foreach ($request->get('socials') as $key => $social) {
                $socialdata[$key] = $social;
            }
            $webinfo->socials = json_encode($socialdata);
        }

        if ($request->has('stats')) {
            $statsdata = [];
            foreach ($request->get('stats') as $key => $stats) {
                $statsdata[$key] = $stats;
            }
            $webinfo->stats = json_encode($statsdata);
        }

        $webinfo->title = trim($request->get('title'));
        $webinfo->desc = trim($request->get('desc'));
        $webinfo->tags = trim($request->get('tags'));
        $webinfo->save();

        return $webinfo->save() ? $webinfo->id : false;

    }

    public function getEditWebInfo($id)
    {

        $this->checkLang();

        $language = $this->language;
        $current_lang = $this->current_lang;
        $webinfo = WebInfo::find($id);

        if (!$webinfo) {
            return view('admin::errors.item_not_found');
        }

        // check if not found record for this locale

        $action = 'edit';

        $language = $this->language;
        $current_lang = $this->current_lang;
        $language_icon = $this->language_icon;
        $language_available = $this->language_available;

        return view('admin::sections.webinfo.create_edit', compact('language', 'language_icon', 'language_available', 'current_lang', 'webinfo', 'action'));

    }

    public function postEditWebInfo(WebInfoRequest $request, $id)
    {
        if ($this->processForm($request, $id)) {
            \Session::flash('success', 'Successfully updated.');
        } else {
            \Session::flash('failed', 'Failed!');
        }
        return redirect()->back();
    }



}