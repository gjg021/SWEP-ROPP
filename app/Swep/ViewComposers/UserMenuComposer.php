<?php

namespace App\Swep\ViewComposers;


use View;
use Auth;
use App\Swep\Repositories\User\UserMenuRepository;


class UserMenuComposer{
   


    protected $user_menu_repo;
	protected $auth;




	public function __construct(UserMenuRepository $user_menu_repo){

        $this->user_menu_repo = $user_menu_repo;
		$this->auth = auth();
    
	}





    public function compose($view){

       // $user_menus = ['user' => $this->auth->guard('web')->user()->slug];
        $user_menus = [];

        if($this->auth->guard('web')->check()){

           $user_menus = $this->user_menu_repo->getCurrentUserMenus();

        }  


    	$view->with('global_user_menus', $user_menus);


    }






}