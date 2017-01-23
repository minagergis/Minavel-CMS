<?php namespace Modules\Admin\Http\Controllers;

use Modules\Admin\Models\Language;
use Modules\Admin\Models\City;
use Modules\Admin\Models\Zone;
use Modules\Admin\Models\ZoneTranslation;

use Modules\Admin\Http\Requests\ZoneRequest;
use Modules\Admin\Http\Requests\DeleteRequest;

class ZoneController extends AdminController {

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
	public function getZone()
	{
        $data['language_icon']      = $this->language_icon;
        $data['language_available'] = $this->language_available;
        return view('admin::sections.location.zone.index', $data);
	}

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAddZone()
    {
        $this->checkLang();

        $lang = $this->current_lang;
        $id   = e(\Request::get('id'));

        if($lang && $id ) {

            $zone = Zone::whereHas('translations', function ($query) use($lang, $id) {
                $query->where('locale', $lang)
                    ->where('zone_id', $id);
            })->first();


            if(count($zone) > 0) {
                return redirect()->route('admin.zone.edit.get', [$id, "lang=$lang" ]);
            }

            $zone = Zone::find($id);
            $action = 'add_translate';

        } else {
            $action = 'add';
        }

        $language = $this->language;
        $current_lang = $this->current_lang;
        $cities = City::all();
        return view('admin::sections.location.zone.create_edit', compact('language', 'current_lang', 'zone', 'cities', 'action'));
    }

    /**
     * @param ZoneRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAddZone(ZoneRequest $request)
    {
        $current_lang = $request->get('current_lang');
        $id = intval($request->get('id'));

        $return = ($id != null) ? $this->processForm($request, $id): $this->processForm($request);

        if ($return > 0) {
            return redirect()->route('admin.zone.edit.get', [$return, "lang=$current_lang" ]);
        } else {
            return view('admin::errors.failed');
            //\Session::flash('failed', 'Failed!');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEditZone($id)
    {
        $this->checkLang();

        $language = $this->language;
        $current_lang = $this->current_lang;
        $zone = Zone::find($id);

        if(!$zone) {
            return view('admin::errors.item_not_found');
        }

        // check if not found record for this locale
        $zone_translate = $zone->translate($current_lang);

        if( !count($zone_translate) > 0) {
            return view('admin::errors.item_not_found');
        }
        $action = 'edit';
        $cities = City::all();
        return view('admin::sections.location.zone.create_edit', compact('zone', 'cities', 'language', 'current_lang', 'action'));
    }


    public function postEditZone(ZoneRequest $request ,$id)
    {
        if($this->processForm($request, $id)) {
            \Session::flash('success', 'Successfully updated.');
        } else {
            \Session::flash('failed', 'Failed!');
        }
        return redirect()->back();
    }

    public function getDeleteZone($id) {
        $zone = Zone::find($id);
        if(!count($zone) > 0) {
            return view('admin::errors.item_not_found');
        }
        return view('admin::sections.location.zone.delete', compact('zone'));
    }


    public function postDeleteZone(DeleteRequest $request, $id) {
        if(Zone::find($request->id)->delete()) {
            return redirect()->route('admin.zone.get');
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
        $zone = ($id == null) ? new Zone : Zone::find($id);

        $zone->city_id = $request->get('city');
        $zone->save();

        $locale = trim($request->get('locale')) ;
        $zone->translateOrNew($locale)->name = trim($request->get('name')) ;

        if($zone->save()) {
            return $zone->id;
        } else {
            return 0;
        }
    }


    public function getZoneData()
    {
        $lang  = \Session::get('lang');

        $zone = ZoneTranslation::all();

        $datatables =  app('datatables')->of($zone);

        foreach ($this->language_available as $l) {
            $datatables ->addColumn($l, function ($zone) use ($l) {

                $c = ZoneTranslation::where('zone_id', $zone->zone_id)
                    ->where('locale', $l)
                    ->get();
                if(count($c) > 0){
                    if($zone->locale == $l) {
                        $icon = 'ok';
                    } else {
                        $icon = 'pencil';
                    }

                    return '<a target="_blank" href="'. route('admin.zone.edit.get', [$zone->zone_id, "&lang=$l"]) .'"><span class="glyphicon glyphicon-'. $icon .'"></span></a>';
                } else {
                    return '<a target="_blank" href="'. route('admin.zone.add.get', "id=$zone->zone_id&lang=$l") .'"><span class="glyphicon glyphicon-plus"></span></a>';
                }

            });
        }


        $datatables ->addColumn('action', function ($zone) {

            return '<a class="btn btn-danger btn-sm" href="'. route('admin.zone.delete.post' , $zone->zone_id) .'"><i class="fa fa-trash"></i>delete</a>';
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
    public function getZoneAjax()
    {
        if(\Request::ajax()){
            $country_id = \Request::get('country_id');
            $cities = Zone::where('country_id', $country_id)->get();
            $data = '';
            foreach ($cities as $city) {
                $data .= '<option value="'. $city->id .'">' . $city->name. '</option>';
            }
            return $data;
        }
        return '';
    }
}