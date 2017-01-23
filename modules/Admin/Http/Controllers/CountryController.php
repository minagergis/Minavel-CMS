<?php namespace Modules\Admin\Http\Controllers;

use Modules\Admin\Models\Language;
use Modules\Admin\Models\Country;
use Modules\Admin\Models\CountryTranslation;

use Modules\Admin\Http\Requests\CountryRequest;
use Modules\Admin\Http\Requests\DeleteRequest;


class CountryController extends AdminController {

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

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function getCountry()
	{
        $data['language_icon']      = $this->language_icon;
        $data['language_available'] = $this->language_available;
		return view('admin::sections.location.country.index', $data);
	}

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAddCountry()
    {
        $this->checkLang();

        $lang = $this->current_lang;
        $id   = e(\Request::get('id'));

        if($lang && $id ) {

            $country = Country::whereHas('translations', function ($query) use($lang, $id) {
                $query->where('locale', $lang)->where('country_id', $id);
            })->first();

            if(count($country) > 0) {
                return redirect()->route('admin.country.edit.get', [$id, "lang=$lang" ]);
            }

            $country = Country::find($id);
            $action = 'add_translate';

        } else {
            $action = 'add';
        }

        $language = $this->language;
        $current_lang = $this->current_lang;
        return view('admin::sections.location.country.create_edit', compact('language', 'current_lang', 'country', 'action'));
    }

    /**
     * @param CountryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAddCountry(CountryRequest $request)
    {
        $id = intval($request->get('id'));

        $return = ($id != null) ? $this->processForm($request, $id): $this->processForm($request);

        if ($return > 0) {
            return redirect()->route('admin.country.edit.get', [$return, "lang=".$request->get('locale') ]);
        } else {
            return view('admin::errors.failed');
            //\Session::flash('failed', 'Failed!');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEditCountry($id)
    {

        $this->checkLang();

        $language = $this->language;
        $current_lang = $this->current_lang;
        $country = Country::find($id);

        if(!$country) {
            return view('admin::errors.item_not_found');
        }

        // check if not found record for this locale
        $country_translate = $country->translate($current_lang);

        if( !count($country_translate) > 0) {
            return view('admin::errors.item_not_found');
        }
        $action = 'edit';
        return view('admin::sections.location.country.create_edit', compact('country', 'language', 'current_lang', 'action'));

    }


    public function postEditCountry(CountryRequest $request ,$id)
    {
        if($this->processForm($request, $id)) {
            \Session::flash('success', 'Successfully updated.');
        } else {
            \Session::flash('failed', 'Failed!');
        }
        return redirect()->back();
    }

    public function getDeleteCountry($id) {
        $country = Country::find($id);

        if(!count($country) > 0) {
            return view('admin::errors.item_not_found');
        }
        return view('admin::sections.location.country.delete', compact('country'));
    }


    public function postDeleteCountry(DeleteRequest $request, $id) {

        if(Country::find($request->id)->delete()) {
            return redirect()->route('admin.country.get');
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
        $country = ($id == null) ? new Country : Country::find($id);

        $country->continent = trim($request->get('continent'));
        $country->code  = $request->get('code');
        $country->code2 = $request->get('code2');
        $country->save();

        $locale = trim($request->get('locale')) ;
        $country->translateOrNew($locale)->name = trim($request->get('name')) ;

        if($country->save()) {
            return $country->id;
        } else {
            return false;
        }

    }


    public function getCountryData()
    {

        $lang  = \Session::get('lang');

        $countries = CountryTranslation::join('country', 'country.id', '=', 'country_translations.country_id')
            ->select([
                'country_translations.name as name',
                'country_translations.locale as locale',
                'country.id as country_id',
            ])
            ->where(function($query) use($lang)
            {
                if($lang == 'all') {
                    $query->whereIn('country_translations.locale', $this->language_available);
                } else {
                    $query->where('country_translations.locale', $lang);
                }

            })
            ->orderby('country.id', 'DESC');


        $datatables =  app('datatables')->of($countries);

        foreach ($this->language_available as $l) {
            $datatables ->addColumn($l, function ($country) use ($l) {

                $c = CountryTranslation::where('country_id', $country->country_id)
                    ->where('locale', $l)
                    ->get();
                if(count($c) > 0){
                    if($country->locale == $l) {
                        $icon = 'ok';
                    } else {
                        $icon = 'pencil';
                    }
                    return '<a target="_blank" href="'. route('admin.country.edit.get', [$country->country_id, "&lang=$l"]) .'"><span class="glyphicon glyphicon-'. $icon .'"></span></a>';
                } else {
                    return '<a target="_blank" href="'. route('admin.country.add.get', "id=$country->country_id&lang=$l") .'"><span class="glyphicon glyphicon-plus"></span></a>';
                }

            });
        }


        $datatables ->addColumn('action', function ($country) {

            return '<a class="btn btn-danger btn-sm" href="'. route('admin.country.delete.post' , $country->country_id) .'"><i class="fa fa-trash"></i>delete</a>';
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