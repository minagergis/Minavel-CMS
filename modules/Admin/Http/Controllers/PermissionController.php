<?php namespace Modules\Admin\Http\Controllers;

use App\Models\Permission;

use Modules\Admin\Http\Requests\PermissionRequest;
use Modules\Admin\Http\Requests\DeleteRequest;


class PermissionController extends AdminController {


    public function __construct()
    {
        parent::__construct();
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function getPermission()
	{
		return view('admin::sections.permissions.index');
	}

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAddPermission()
    {
        return view('admin::sections.permissions.create_edit');
    }

    /**
     * @param PermissionRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAddPermission(PermissionRequest $request)
    {
        $return = $this->processForm($request);
        if ($return > 0) {
            return redirect()->route('admin.permissions.edit.get' , $return);
        } else {
            return view('admin::errors.failed');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEditPermission($id)
    {
        $permission = Permission::find($id);

        if(!$permission) {
            return view('admin::errors.item_not_found');
        }

        return view('admin::sections.permissions.create_edit', compact('permission'));
    }


    public function postEditPermission(PermissionRequest $request ,$id)
    {
        if($this->processForm($request, $id)) {
            \Session::flash('success', 'Successfully updated.');
        } else {
            \Session::flash('failed', 'Failed!');
        }
        return redirect()->back();
    }

    public function getDeletePermission($id) {
        $permission = Permission::find($id);

        if(!count($permission) > 0) {
            return view('admin::errors.item_not_found');
        }
        return view('admin::sections.permissions.delete', compact('permission'));
    }


    public function postDeletePermission(DeleteRequest $request, $id) {

        if(Permission::find($request->id)->delete()) {
            return redirect()->route('admin.permissions.get');
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
        $permission = $id == null ? new Permission : Permission::find($id);

        $permission->name           = $request->get('name');
        $permission->display_name   = $request->get('display_name');
        $permission->description    = $request->get('description');
        $permission->category       = $request->get('category');

        if($permission->save()) {
            return $permission->id;
        } else {
            return false;
        }

    }


    public function getPermissionData()
    {

        $permissions = Permission::all();

        $datatables =  app('datatables')->of($permissions);

        $datatables ->editColumn('name', function ($permission) {

            return '<a href="'. route('admin.permissions.edit.get' , $permission->id) .'"><i class="fa fa-edit"></i> &nbsp;'. $permission->name .'</a>';
        });

        $datatables ->addColumn('action', function ($permission) {
            return '<a class="btn btn-danger btn-sm" href="'.route('admin.permissions.delete.get', $permission->id).'"><i class="fa fa-trash"></i>Delete</a>';
        });

        return  $datatables->make(true);
    }
}