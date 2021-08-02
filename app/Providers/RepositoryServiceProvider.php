<?php

namespace App\Providers;
 
use Illuminate\Support\ServiceProvider;
 

class RepositoryServiceProvider extends ServiceProvider {
	


	public function register(){

		$this->app->bind('App\Core\Interfaces\UserInterface', 'App\Core\Repositories\UserRepository');

		$this->app->bind('App\Core\Interfaces\UserMenuInterface', 'App\Swep\Repositories\User\UserMenuRepository');

		$this->app->bind('App\Core\Interfaces\UserSubmenuInterface', 'App\Core\Repositories\UserSubmenuRepository');


		$this->app->bind('App\Core\Interfaces\MenuInterface', 'App\Core\Repositories\MenuRepository');

		$this->app->bind('App\Core\Interfaces\SubmenuInterface', 'App\Core\Repositories\SubmenuRepository');

		$this->app->bind('App\Core\Interfaces\ProfileInterface', 'App\Core\Repositories\ProfileRepository');
		

		$this->app->bind('App\Swep\Interfaces\Admin\MenuInterface', 'App\Swep\Repositories\Admin\MenuRepository');

		$this->app->bind('App\Swep\Interfaces\Admin\FunctionInterface', 'App\Swep\Repositories\Admin\FunctionRepository');

		$this->app->bind('App\Swep\Interfaces\Admin\AdminInterface', 'App\Swep\Repositories\Admin\AdminRepository');

		$this->app->bind('App\Swep\Interfaces\Admin\AdminFunctionsInterface', 'App\Swep\Repositories\Admin\AdminFunctionsRepository');


		$this->app->bind('App\Swep\Interfaces\User\UserMenuInterface', 'App\Swep\Repositories\User\UserMenuRepository');

		$this->app->bind('App\Swep\Interfaces\User\UserInterface', 'App\Swep\Repositories\User\UserRepository');

        $this->app->bind('App\Swep\Interfaces\User\OrderOfPaymentInterface', 'App\Swep\Repositories\User\OrderOfPaymentRepository');


	}



}