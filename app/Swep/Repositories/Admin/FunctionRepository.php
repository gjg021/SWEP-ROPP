<?php

namespace App\Swep\Repositories\Admin;
 
use App\Swep\BaseClasses\Admin\BaseRepository;
use App\Swep\Interfaces\Admin\FunctionInterface;

use App\Models\Admin\Functions;
use Auth;

class FunctionRepository extends BaseRepository implements FunctionInterface {
    

    protected $function;


    public function __construct(Functions $function){

        // $this->menu = $menu;
        parent::__construct();


        $this->function = $function;
    }




    public function fetch($slug){

        // $menu = $this->menu;

        // return $menu->where('slug','=',$slug)->first();

    }

    public function fetchTable($data){
        //return $data;
        $get = $this->function;

        return $get->where('menu_slug','=',$data->get('menu_slug'))->get();
    }


    public function store($request){
     
        if(empty($request->menu_slug)){
            abort(500,"A required field which is set to be not nullabe in database is missing.");
        }

        $function = new Functions;
        $function->slug = $this->str->random(10);
        $function->menu_slug = $request->menu_slug;
        $function->function_name = $request->function_name;
        $function->function_label = $request->function_label;
        $function->function_route = $request->function_route;
        $function->function_is_nav = $request->function_is_nav;
        $function->function_icon = $request->function_icon;
        $function->function_belongs_to = $request->function_belongs_to;
        if(!$function->save()){
            abort(500, 'Error saving data');
        }
        
        return $function;

    }




    public function update($request, $slug){


        $function = $this->findBySlug($slug);
        $function->function_name = $request->function_name;
        $function->function_route = $request->function_route;
        $function->function_label = $request->function_label;
        $function->function_is_nav = $request->function_is_nav;
        $function->function_icon = $request->function_icon;
        $function->function_belongs_to = $request->function_belongs_to;
        if(!$function->save()){
            abort(500, 'Error updating data.');
        }

        return $function;

    }




    public function destroy($slug){

        $function = $this->findBySlug($slug);
        $function->delete();

        return 1;
    }

    public function findBySlug($slug){
        $function = $this->function;
        $function = $function->where('slug','=' ,$slug)->first();
        return $function;
    }



    public function findByRouteName($route_name){

    
        $function = $this->function->where('function_route','=',$route_name)->first();
        return $function;
    }




}