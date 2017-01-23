<?php namespace Modules\Admin\Http\Controllers;

use Modules\Admin\Http\Requests\UserRequest;
use Modules\Admin\Http\Requests\DeleteRequest;
use App\Models\User;
use App\Models\Role;
use App\Models\Role_User;
use Modules\Admin\Models\Country;


class UserController extends AdminController {


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function getUsers()
	{
		return view('admin::sections.users.index');
	}


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getAddUser()
    {
        $roles = Role::all();
        $countries   = Country::all();
        return view('admin::sections.users.create_edit', compact('countries','roles'));
    }


    /**
     * @param UserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postAddUser(UserRequest $request)
    {
        $return = $this->processForm($request);
        if ($return > 0) {
            return redirect()->route('admin.users.edit.get' , $return);
        } else {
            return view('admin::errors.failed');
        }
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getEditUser($id)
    {
        $user = User::find($id);
        $select_role = Role_User::where('user_id', $id)->first();
        $roles = Role::all();
        $countries   = Country::all();
        if(!count($user) > 0) {
            return view('admin::errors.item_not_found');
        }

//        $role_user= Role_User::where('user_id', $id)->lists('role_id')->toArray();

        return view('admin::sections.users.create_edit', compact('user', 'select_role','roles', 'countries'));

    }

    /**
     * @param UserRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEditUser(UserRequest $request, $id)
    {
        if($this->processForm($request, $id)) {
            \Session::flash('success', 'Successfully Updated.');
        } else {
            \Session::flash('failed', 'Failed.');
        }

        return redirect()->back();
    }


    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getDeleteUser($id) {
        $user = User::find($id);

        if(!count($user) > 0) {
            return view('admin::errors.item_not_found');
        }

        return view('admin::sections.users.delete', compact('user'));
    }

    /**
     * @param DeleteRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function postDeleteUser(DeleteRequest $request, $id) {

        if(User::find($request->id)->delete()) {
            return redirect()->route('admin.users.get');
        }

        return 'Failed';
    }


    /**
     * Add/Edit User
     * @param $request
     * @param null $id
     * @return bool
     */
    protected function processForm($request , $id = null )
    {
        $user = $id == null ? new User() : User::find($id);

        $user->username     = $request->get('username');
        $user->email        = $request->get('email');
        $user->name         = $request->get('name');

        $user->job          = $request->get('job');
        $user->mobile       = $request->get('mobile');
        $user->age          = $request->get('age');
        $user->about        = $request->get('about');
        $user->url          = $request->get('url');
        $user->address      = $request->get('address');

        $user->city_id      = $request->has('city_id') ? $request->get('city_id') : null;
        $user->country_id   = $request->has('country_id') ? $request->get('country_id') : null;


        if( $request->has('password') ) {
            $user->password  = bcrypt($request->get('password'));
        }
/*
        \Mail::send('company::sections.contact_us.contact',
        array(
            'name' => $request->get('name_contact'),
            'email' => $request->get('email_contact'),
            'user_message' => $request->get('message_contact'),
            'phone_contact' => $request->get('phone_contact'),
            'lastname_contact' => $request->get('lastname_contact'),
        ), function($message)
        {
            $message->from('mostafa.torra@gmail.com');
            $message->to('mostafa.torra@gmail.com', 'Admin')->subject('Otb system Contact us ');
        });
*/


        if($user->save()) {
            /*============Roles Section Start=============*/
            if(Role_User::where('user_id', $user->id)) {
                Role_User::where('user_id', $user->id)->delete();
                Role_User::create(['user_id' => $user->id, 'role_id' => $request->get('role') ]);
            }else{
                if($request->get('roles')){
                    Role_User::create(['user_id' => $user->id, 'role_id' => $request->get('role') ]);
                }
            }
            /*============Roles Section End===============*/
            return $user->id;
        } else {
            return false;
        }
    }

    /**
     * Get all users.
     *
     * @return user
     */
    public function getUserData()
    {

        $users = User::all();

        $datatables =  app('datatables')->of($users);

        $datatables ->editColumn('name', function ($user) {
            return '<a href="'. route('admin.users.edit.get' , $user->id) .'"><i class="fa fa-edit"></i> &nbsp;'. $user->name .'</a>';
        });

        $datatables ->addColumn('action', function ($user) {
            return '<a class="btn btn-danger btn-sm" href="'. route('admin.users.delete.get' , $user->id) .'"><i class="fa fa-trash"></i>delete</a>';
        });

        return  $datatables->make(true);
    }
}