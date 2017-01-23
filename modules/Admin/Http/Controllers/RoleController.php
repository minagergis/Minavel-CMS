<?php namespace Modules\Admin\Http\Controllers;


use App\Models\Role;
use App\Models\Permission;
use App\Models\Permission_Role;

use Modules\Admin\Http\Requests\RoleRequest;
use Modules\Admin\Http\Requests\DeleteRequest;

class RoleController extends AdminController {

    public function __construct()
    {
        parent::__construct();
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function getRole()
	{
		return view('admin::sections.roles.index');
	}

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAddRole()
    {
        $categories = Permission::all()->groupBy('category');
        return view('admin::sections.roles.create_edit', compact('categories'));
    }


    /**
     * @param RoleRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAddRole(RoleRequest $request)
    {
        $return = $this->processForm($request);
        if ($return > 0) {
            return redirect()->route('admin.roles.edit.get' , $return);
        } else {
            return view('admin::errors.failed');
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEditRole($id)
    {
        $role = Role::find($id);
        $categories = Permission::all()->groupBy('category');
        $permission_role = Permission_Role::where('role_id', $id)->lists('permission_id')->toArray();

        if(!$role) {
            return view('admin::errors.item_not_found');
        }

        return view('admin::sections.roles.create_edit', compact('role', 'categories', 'permission_role'));
    }


    public function postEditRole(RoleRequest $request ,$id)
    {
        if($this->processForm($request, $id)) {
            \Session::flash('success', 'Successfully updated.');
        } else {
            \Session::flash('failed', 'Failed!');
        }
        return redirect()->back();
    }


    public function getDeleteRole($id) {
        $role = Role::find($id);

        if(!count($role) > 0) {
            return view('admin::errors.item_not_found');
        }
        return view('admin::sections.roles.delete', compact('role'));
    }


    public function postDeleteRole(DeleteRequest $request, $id) {
        if (Role::find($request->id)) {
            Role::find($request->id)->delete();
            return redirect()->route('admin.roles.get');
        }
        return 'Failed';
    }

    protected function processForm($request , $id = null )
    {
        $role = ($id == null) ? new Role : Role::find($id);

        $role->name         = $request->get('name');
        $role->display_name = $request->get('display_name');
        $role->save();

        if($role->id > 0) {
            Permission_Role::where('role_id', $role->id)->delete();

            if($request->get('permissions')) {
                foreach ($request->get('permissions') as $permission) {
                    Permission_Role::create(['permission_id' => $permission, 'role_id' => $role->id]);
                }
            }
            return $role->id;
        } else {
            return false;
        }
    }


    public function getRoleData()
    {

        $roles = Role::all();

        $datatables =  app('datatables')->of($roles);

        $datatables ->editColumn('name', function ($role) {

            return '<a href="'. route('admin.roles.edit.get' , $role->id) .'"><i class="fa fa-edit"></i> &nbsp;'. $role->name .'</a>';
        });

        $datatables ->addColumn('action', function ($role) {
            return '<a class="btn btn-danger btn-sm" href="'.route('admin.roles.delete.get', $role->id).'"><i class="fa fa-trash"></i>Delete</a>';
        });

        return  $datatables->make(true);
    }
}