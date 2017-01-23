<?php namespace Modules\Admin\Http\Controllers;


class EditorController extends AdminController {
	
	public function getEditor()
	{
		return view('admin::sections.editor.index');
	}


    public function getAddEditor()
    {
        return view('admin::sections.editor.create_edit');
    }
	
}