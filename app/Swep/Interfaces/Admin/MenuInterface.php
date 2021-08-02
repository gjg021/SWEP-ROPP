<?php

namespace App\Swep\Interfaces\Admin;
 


interface MenuInterface {

	public function fetch($request);

	public function store($request);

	public function update($request, $slug);

	public function destroy($slug);


		
}