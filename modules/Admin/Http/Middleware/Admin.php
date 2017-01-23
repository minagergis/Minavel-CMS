<?php namespace Modules\Admin\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Routing\Middleware;
use Illuminate\Contracts\Routing\ResponseFactory;
use Zizaco\Entrust\Traits\EntrustUserTrait;

use App\Models\AssignedRoles;

class Admin{

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * The response factory implementation.
     *
     * @var ResponseFactory
     */
    protected $response;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @param  ResponseFactory  $response
     * @return void
     */
    public function __construct(Guard $auth,
                                ResponseFactory $response)
    {
        $this->auth = $auth;
        $this->response = $response;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->check())
        {
            $admin = 0;
           if(\Auth::user()->can('admin.login'))
            {
               $admin=1;
            }

            if($admin==0){
               return $this->response->redirectTo('/admin/login');
            }

            return $next($request);
        }
        
        return $this->response->redirectTo('/admin/login');
    }

}