<?php

namespace App\Http\Middleware;


use Auth;
use Session;
use Closure;



class CheckUserStatus{


    protected $auth;
    protected $session;




    public function __construct(){

        $this->auth = auth('web');
        $this->session = session();
        
    }




    public function handle($request, Closure $next){

        if(\Auth::guard('web')->check()){

            if($this->auth->user()->is_verified == 0){

                $this->auth->logout();
                $this->session->flush();
                $this->session->flash('CHECK_IF_VERIFIED', 'You have not yet verified your email address.');
                return redirect('/');

            }

            if($this->auth->user()->is_active == 0){

                $this->auth->logout();
                $this->session->flush();
                $this->session->flash('CHECK_IF_ACTIVATED', 'Your account is deactivated. Contact the administrator');
                return redirect('/');

            }

            return $next($request);

        }

        $this->session->flush();
        $this->session->flash('CHECK_UNAUTHENTICATED', 'Please Sign in to start your session.');
        return redirect('/');
    
    }





}
