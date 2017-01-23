<?php namespace Modules\Admin\Http\Controllers;


class MenuController extends AdminController {
	
	public function getMenu()
	{
		return view('admin::sections.menus.index');
	}


    public function getAddMenu()
    {
        return view('admin::sections.menus.create_edit');
    }
	
}