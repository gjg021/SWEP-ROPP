<?php

namespace App\Swep\Repositories\Admin;
 
use App\Swep\BaseClasses\Admin\BaseRepository;
use App\Swep\Interfaces\Admin\AdminFunctionsInterface;
use App\Swep\Interfaces\Admin\FunctionInterface;

use App\Models\Admin\AdminFunctions;
use Auth;
use Hash;
use Route;
class AdminFunctionsRepository extends BaseRepository implements AdminFunctionsInterface {
    

    protected $admin_functions;
    protected $functions;

    public function __construct(AdminFunctions $admin_functions, FunctionInterface $functions){

        $this->admin_functions = $admin_functions;
        $this->functions = $functions;

        parent::__construct();
    }




    public function fetch($slug){

       

    }

    public function fetchTable($data){
        // $get = $this->menu;

        // return $get->latest()->get();
    }


    public function store($request){
        
        $admin_functions = new AdminFunctions;

        $admin_functions->admin_slug = $request->admin_slug;
        $admin_functions->function_slug = $request->function_slug;

        $admin_functions->save();


    }




    public function update($request, $slug){

       

    }

    public function fetchByAdminSlug($slug){
        $admin_functions = $this->admin_functions->where('admin_slug','=',$slug)->get();
        return $admin_functions;
    }


    public function destroy($slug){

       

    }

    public function findBySlug($slug){
        
    }




    public function getRaw(){
        
    }


    public function checkRouteExists(){

        $route_name = Route::currentRouteName();
        // $route_name = 'admin.menus.store';

        $admin_slug = $this->auth->guard('admin')->user()->slug;
        $function = $this->functions->findByRouteName($route_name);
        if(empty($function)){
            return false;
        }
        
        $function_slug = $function->slug;
        $admin_functions = $this->admin_functions
                             ->where('admin_slug', '=',$admin_slug)
                             ->where('function_slug','=', $function_slug);


        if($admin_functions->exists()){
            return true;
        }else{
            return false;
        }


    }

}