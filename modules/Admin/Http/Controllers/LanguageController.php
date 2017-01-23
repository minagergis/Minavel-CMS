<?php namespace Modules\Admin\Http\Controllers;

use Modules\Admin\Models\Language;

use Modules\Admin\Http\Requests\LanguageRequest;
use Modules\Admin\Http\Requests\DeleteRequest;

class LanguageController extends AdminController {
	
	public function getLanguage()
	{
		return view('admin::sections.languages.create_edit');
	}


    public function getAddLanguage()
    {
        return view('admin::sections.languages.create_edit');
    }

    public function postAddLanguage(LanguageRequest $request)
    {
        $return = $this->processForm($request);
        if ($return > 0) {
            return redirect()->route('admin.languages.get' , $return);
        } else {
            return view('admin::errors.failed');
        }
    }

    public function getEditLanguage($id)
    {
        $language = Language::find($id);

        if(!$language) {
            return view('admin::errors.item_not_found');
        }

        return view('admin::sections.languages.create_edit', compact('language'));
    }

    public function postEditLanguage(LanguageRequest $request ,$id)
    {
        if($this->processForm($request, $id)) {
            \Session::flash('success', 'Successfully updated.');
        } else {
            \Session::flash('failed', 'Failed!');
        }
        return redirect()->back();
    }

    public function getDeleteLanguage($id) {
        $language = Language::find($id);

        if(!count($language) > 0) {
            return view('admin::errors.item_not_found');
        }
        return view('admin::sections.languages.delete', compact('language'));
    }


    public function postDeleteLanguage(DeleteRequest $request, $id) {

        if(Language::find($request->id)->delete()) {
            return redirect()->route('admin.languages.get');
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
        $language = $id == null ? new Language : Language::find($id);

        $language->name     = $request->get('full_name');
        $language->locale   = $request->get('locale');
        $language->icon     = $request->get('flag');

        if($language->save()) {
            return $language->id;
        } else {
            return false;
        }

    }

    public function setLanguageSession($lang)
    {
        $language = Language::select(['name', 'locale', 'icon'])->get();
        $language_available = array_pluck($language, 'locale');
        $language_available[] = 'all';

        $lang = $lang !== null ? e($lang) : 'en';
        if(!in_array($lang, $language_available)) {
            abort(404);
        }

        if(\Session::has('lang'))
            \Session::put('lang', $lang);
        else
            \Session::set('lang', $lang);

        return redirect()->back();
    }

    public function getLanguageData()
    {

        $languages = Language::all();

        $datatables =  app('datatables')->of($languages);

        $datatables ->editColumn('name', function ($language) {
            return '<a href="'. route('admin.languages.edit.get' , $language->id) .'"><i class="fa fa-edit"></i> &nbsp;'. $language->name .'</a>';
        });

        $datatables ->editColumn('icon', function ($language) {
            return '<i class="glyphicon bfh-flag-'. $language->icon .'"></i>';
        });

        $datatables ->addColumn('action', function ($language) {
            return '<a class="btn btn-danger btn-sm" href="'.route('admin.languages.delete.get', $language->id).'"><i class="fa fa-trash"></i>Delete</a>';
        });

        return  $datatables->make(true);
    }
}