<?php namespace Modules\Admin\Http\Controllers;


use Modules\Admin\Models\Settings;
use Modules\Admin\Http\Requests\SettingsRequest;
use Config;

class SettingsController extends AdminController {

    public $setting ;


    public function __construct(Settings $settings)
    {
        parent::__construct();

        $this->setting = $settings ;
    }



    public function getSettings()
    {
        return view('admin::sections.settings.general');
    }


    public function postSettings(SettingsRequest $request)
    {

        foreach(Config::get('settings.attributes') as $attr)
        {
            $this->setting->where('name', $attr['slug'])->delete();
            $this->setting->create(['name' => $attr['slug'] ,'value' => $request->get($attr['slug'])]);
        }

        return redirect()->back();
    }
}