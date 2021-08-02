<?php

namespace App\Http\Controllers\Auth;

use App\Core\Interfaces\UserInterface;

use Auth;
use Session;
use Illuminate\Http\Request;
use App\Core\Helpers\__cache;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class LoginController extends Controller{
   

    use AuthenticatesUsers;

    protected $user_repo;

    protected $auth;
    protected $session;
    protected $__cache;
    protected $event;
    protected $redirectTo = 'dashboard/home';
    protected $maxAttempts = 4;
    protected $decayMinutes = 2;





    public function __construct(UserInterface $user_repo, __cache $__cache){


        $this->user_repo = $user_repo;

        $this->auth = auth();
        $this->session = session();
        $this->__cache = $__cache;

        $this->middleware('guest:web')->except('logout');

    }





    
    public function username(){

        return 'email';
    
    }






    protected function login(Request $request){
        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }


        if($this->auth->guard('web')->attempt($this->credentials($request))){

            if($this->auth->user()->is_active == false){

                $this->session->flush();
                $this->session->flash('AUTH_UNACTIVATED','Your account is currently UNACTIVATED! Please contact the designated IT Personel to activate your account.');
                $this->auth->logout();

            }else{

                //$user = $this->user_repo->login($this->auth->user()->slug);

                // $this->__cache->deletePattern(''. config('app.name') .'_cache:users:fetch:*');
                // $this->__cache->deletePattern(''. config('app.name') .'_cache:users:findBySlug:'. $user->slug .'');
                // $this->__cache->deletePattern(''. config('app.name') .'_cache:users:getByIsOnline:'. $user->is_online .'');

                $this->clearLoginAttempts($request);
                return redirect()->intended('dashboard/home');

            }

        }

        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);

    }






    public function logout(Request $request){
        
        if($request->isMethod('get')){

            //$user = $this->user_repo->logout($this->auth->user()->slug);
            
            $this->session->flush();
            $this->auth->guard('web')->logout();
            // $request->session()->invalidate();

            // // $this->__cache->deletePattern(''. config('app.name') .'_cache:users:fetch:*');
            // $this->__cache->deletePattern(''. config('app.name') .'_cache:users:findBySlug:'. $user->slug .'');
            // $this->__cache->deletePattern(''. config('app.name') .'_cache:users:getByIsOnline:'. $user->is_online .'');

            // $this->session->flash('LOGOUT_SUCCESS','You have been logged out successfully!');

            return redirect('/');

        }
        
        return abort(404);

    }









}
