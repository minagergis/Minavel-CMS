<?php namespace Modules\Admin\Http\Controllers;

use Modules\Admin\Models\Language;
use Modules\Admin\Models\City;
use Modules\Admin\Models\Country;
use Modules\Admin\Models\CityTranslation;

use Modules\Admin\Http\Requests\CityRequest;
use Modules\Admin\Http\Requests\DeleteRequest;

class CityController extends AdminController {

    /**
     * @var $current_lang, $language, $language_available
     */
    private $current_lang, $language, $language_available, $language_icon;

    public function __construct()
    {
        parent::__construct();

        $this->language = Language::select(['name', 'locale', 'icon'])->get();
        $this->language_available = array_pluck($this->language, 'locale');
        $this->language_icon = array_pluck($this->language, 'icon');
    }



    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function getCity()
	{
        $data['language_icon']      = $this->language_icon;
        $data['language_available'] = $this->language_available;
        return view('admin::sections.location.city.index', $data);
	}

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAddCity()
    {
        $this->checkLang();

        $lang = $this->current_lang;
        $id   = e(\Request::get('id'));

        if($lang && $id ) {

            $city = City::whereHas('translations', function ($query) use($lang, $id) {
                $query->where('locale', $lang)
                    ->where('city_id', $id);
            })->first();


            if(count($city) > 0) {
                return redirect()->route('admin.city.edit.get', [$id, "lang=$lang" ]);
            }

            $city = City::find($id);
            $action = 'add_translate';

        } else {
            $action = 'add';
        }

        $language = $this->language;
        $current_lang = $this->current_lang;
        $countries = Country::all();
        return view('admin::sections.location.city.create_edit', compact('language', 'current_lang', 'city', 'countries', 'action'));
    }

    /**
     * @param CityRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAddCity(CityRequest $request)
    {
        $current_lang = $request->get('current_lang');
        $id = intval($request->get('id'));

        $return = ($id != null) ? $this->processForm($request, $id): $this->processForm($request);

        if ($return > 0) {
            return redirect()->route('admin.city.edit.get', [$return, "lang=$current_lang" ]);
        } else {
            return view('admin::errors.failed');
            //\Session::flash('failed', 'Failed!');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEditCity($id)
    {

        $this->checkLang();

        $language = $this->language;
        $current_lang = $this->current_lang;
        $city = City::find($id);

        if(!$city) {
            return view('admin::errors.item_not_found');
        }

        // check if not found record for this locale
        $country_translate = $city->translate($current_lang);

        if( !count($country_translate) > 0) {
            return view('admin::errors.item_not_found');
        }
        $action = 'edit';
        $countries = Country::all();
        return view('admin::sections.location.city.create_edit', compact('city', 'countries', 'language', 'current_lang', 'action'));
    }


    public function postEditCity(CityRequest $request ,$id)
    {
        if($this->processForm($request, $id)) {
            \Session::flash('success', 'Successfully updated.');
        } else {
            \Session::flash('failed', 'Failed!');
        }
        return redirect()->back();
    }

    public function getDeleteCity($id) {
        $city = City::find($id);
        if(!count($city) > 0) {
            return view('admin::errors.item_not_found');
        }
        return view('admin::sections.location.city.delete', compact('city'));
    }


    public function postDeleteCity(DeleteRequest $request, $id) {
        if(City::find($request->id)->delete()) {
            return redirect()->route('admin.city.get');
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
        $city = ($id == null) ? new City : City::find($id);

        $city->country_id = $request->get('country');
        $city->save();

        $locale = trim($request->get('locale')) ;
        $city->translateOrNew($locale)->name = trim($request->get('name')) ;

        if($city->save()) {
            return $city->id;
        } else {
            return 0;
        }
    }


    public function getCityData()
    {

        $lang  = \Session::get('lang');

        $cities = CityTranslation::all();

        $datatables =  app('datatables')->of($cities);

        foreach ($this->language_available as $l) {
            $datatables ->addColumn($l, function ($city) use ($l) {

                $c = CityTranslation::where('city_id', $city->city_id)
                    ->where('locale', $l)
                    ->get();
                if(count($c) > 0){
                    if($city->locale == $l) {
                        $icon = 'ok';
                    } else {
                        $icon = 'pencil';
                    }

                    return '<a target="_blank" href="'. route('admin.city.edit.get', [$city->city_id, "&lang=$l"]) .'"><span class="glyphicon glyphicon-'. $icon .'"></span></a>';
                } else {
                    return '<a target="_blank" href="'. route('admin.city.add.get', "id=$city->city_id&lang=$l") .'"><span class="glyphicon glyphicon-plus"></span></a>';
                }

            });
        }

        $datatables ->addColumn('action', function ($city) {

            return '<a class="btn btn-danger btn-sm" href="'. route('admin.city.delete.post' , $city->id) .'"><i class="fa fa-trash"></i>delete</a>';
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

    /**
     * Get ajax zone.
     *
     * @return $cities
     */
    public function getCityAjax()
    {
        if(\Request::ajax()){
            $country_id = \Request::get('country_id');
            $cities = City::where('country_id', $country_id)->get();
            $data = '';
            foreach ($cities as $city) {
                $data .= '<option value="'. $city->id .'">' . $city->name. '</option>';
            }
            return $data;
        }
        return '';
    }
}