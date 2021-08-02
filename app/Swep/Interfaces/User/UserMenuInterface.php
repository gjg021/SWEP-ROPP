<?php

namespace App\Swep\Interfaces\User;
 


interface UserMenuInterface {

	public function store($user, $menu);

	public function getAll();
		
}