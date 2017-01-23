<?php namespace Modules\Admin\Http\Controllers;


class ContactController extends AdminController {
	
	public function getContact()
	{
		return view('admin::sections.contact.index');
	}


    public function getAddContact()
    {
        return view('admin::sections.contact.create_edit');
    }
	
}