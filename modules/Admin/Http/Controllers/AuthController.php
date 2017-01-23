<?php
/**
 * Created by PhpStorm.
 * User: Moaaz
 * Date: 3/29/2016
 * Time: 12:07 PM
 */

namespace Modules\Admin\Http\Controllers;


use App\Models\User;
use Modules\Admin\Http\Requests\LoginRequest;
use Pingpong\Modules\Routing\Controller;

class AuthController extends Controller
{

    protected $loginPath = '/login';
    protected $redirectTo = '/';
    protected $redirectAfterLogout = '/';

    public function getRegister()
    {
        return view('admin::sections.auth.register');
    }

    public function getLogin()
    {
        return view('admin::sections.auth.login');

    }

    public function postLogin(LoginRequest $request)
    {
        $this->validate($request, [
            'email' => 'required|email', 'password' => 'required',
        ]);

        if (\Auth::validate(['email' => $request->email, 'password' => $request->password, 'status' => 0])) {
            
            return redirect()->route('admin.login.get')
                ->withInput($request->only('email', 'remember'))
                ->withErrors([
                    'email' => trans('main.account_not_active'),
                ]);
        }

        $credentials  = array('email' => $request->email, 'password' => $request->password);
        if (\Auth::attempt($credentials, $request->has('remember'))){
            //return redirect()->intended($this->redirectPath());admin.search.get
            return redirect()->route('admin.home.get');
        }

        return redirect()->route('admin.login.get')
            ->withInput($request->only('email', 'remember'))
            ->withErrors([
                'email' => trans('main.incorrect_credintal'),
            ]);
    }


    public function getLogout()
    {
        \Auth::logout();
        return redirect()->route('admin.login.get');
    }

}