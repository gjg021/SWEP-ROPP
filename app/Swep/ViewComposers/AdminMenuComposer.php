<?php

namespace App\Swep\ViewComposers;


use View;
use Auth;
use App\Swep\Repositories\Admin\AdminRepository;


class AdminMenuComposer{
   


    protected $admin_repo;
	protected $auth;




	public function __construct(AdminRepository $admin_repo){

        $this->admin_repo = $admin_repo;
		$this->auth = auth();
    
	}





    public function compose($view){

        $admin_menus = [];


        if($this->auth->guard('admin')->check()){

            $admin_menus = $this->admin_repo->currentAdminMenusTree();

        }  


    	$view->with('global_admin_menus', $admin_menus);


    }






}