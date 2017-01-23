<?php namespace Modules\Admin\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class AdminController extends Controller {

	/**
	 * Initializer.
	 *
	 * @return \AdminController
	 */
	public function __construct()
	{
		if(!\Session::has('lang')) {
			\Session::put('lang', 'all');
		}
	}

	public function index()
	{
		return view('admin::index');
	}

}