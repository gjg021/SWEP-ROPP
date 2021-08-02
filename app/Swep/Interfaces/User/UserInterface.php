<?php

namespace App\Swep\Interfaces\User;
 


interface UserInterface {

	public function fetch($request);

	public function store($request);

	public function update($request, $slug);

	public function destroy($slug);


		
}