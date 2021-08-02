<?php

namespace App\Swep\Repositories\Admin;
 
use App\Swep\BaseClasses\Admin\BaseRepository;
use App\Swep\Interfaces\Admin\MenuInterface;

use App\Models\Admin\Menu;
use Auth;

class MenuRepository extends BaseRepository implements MenuInterface {
    

    protected $menu;


    public function __construct(Menu $menu){

        // $this->menu = $menu;
        parent::__construct();


        $this->menu = $menu;
    }




    public function fetch($slug){

        $menu = $this->menu;

        return $menu->where('slug','=',$slug)->first();

    }

    public function fetchTable($data){
        $get = $this->menu->with('functions');

        return $get->latest()->get();
    }


    public function store($request){
        
        $menu = new Menu;
        $menu->slug = $this->str->random(10);
        $menu->menu_name = $request->menu_name;
        $menu->label = $request->menu_label;
        $menu->route = $request->menu_route;
        $menu->icon = $request->menu_icon;
        $menu->is_nav = $request->menu_is_nav;
        $menu->is_dropdown = $request->menu_is_dropdown;
        $menu->created_at = $this->carbon->now();
        $menu->updated_at = $this->carbon->now();
        $menu->ip_created = request()->ip();
        $menu->ip_updated = request()->ip();
        $menu->user_created = $this->auth->guard('admin')->user()->slug;
        $menu->user_updated = $this->auth->guard('admin')->user()->slug;
        
        if(!$menu->save()){
            abort(500, 'Error saving data');
        }
        
        return $menu;

    }




    public function update($request, $slug){

        $menu = $this->findBySlug($slug);


        $menu->menu_name = $request->menu_name;
        $menu->route = $request->menu_route;
        $menu->icon = $request->menu_icon;
        $menu->label = $request->menu_label;
        $menu->is_nav = $request->menu_is_nav;
        $menu->is_dropdown = $request->menu_is_dropdown;
    
        $menu->updated_at = $this->carbon->now();
        $menu->ip_updated = request()->ip();
        $menu->user_updated = $this->auth->guard('admin')->user()->slug;
        
        if(!$menu->save()){
            abort(500,"Error updating data.");
        }
        return $menu;
         
        // return $menu;

    }




    public function destroy($slug){

        $menu = $this->findBySlug($slug);
        $menu->delete();
        $menu->functions()->delete();

        return 1;

    }

    public function findBySlug($slug){
        $menu = $this->menu->where('slug','=',$slug)->first();
        return $menu; 
    }




    public function getRaw(){
        $menu = $this->menu;
        return $menu;
    }


    public function allAdminMenusTree(){
        $menu_array = [];
        $menu_db = $this->menu->where('belongs_to','=','admin')->get();

        foreach ($menu_db as $key=> $menu) {
            $menu_array[$menu->menu_name] = [];
            $menu_array[$menu->menu_name]['functions'] = [];
            $menu_array[$menu->menu_name]['menu_obj'] = $menu;
           

            foreach ($menu->functions as $function) {
                $menu_array[$menu->menu_name]['functions'][$function->function_name]['function_obj'] = $function;
            }
        }

        // foreach ($menu_db as $menu) {
        //     $menu_array[$menu->menu_name] = [];

        //     foreach ($menu->functions as $function) {
        //         $menu_array[$menu->menu_name] = [];
        //         $menu_array[$menu->menu_name]['menu'] = [];
        //     }
            
        // }

        return $menu_array;
    }

}