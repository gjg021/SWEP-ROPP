<?php

namespace App\Swep\Interfaces\Admin;



interface SucroseInterface {

    public function fetch($request);

    public function store($request);

    public function update($request, $slug);

    public function destroy($slug);
}