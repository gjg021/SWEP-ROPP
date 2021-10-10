<?php

namespace App\Swep\Repositories\Admin;
 
use App\Swep\BaseClasses\Admin\BaseRepository;
use App\Swep\Interfaces\Admin\AdminInterface;


use App\Models\Admin;
use Auth;
use Hash;
use DB;

class AdminRepository extends BaseRepository implements AdminInterface {
    

    protected $admin;
    protected $menu_repo;

    public function __construct(Admin $admin,MenuRepository $menu_repo){

        $this->admin = $admin;
        $this->menu_repo = $menu_repo;
        parent::__construct();
    }




    public function fetch($slug){

       

    }

    public function fetchTable($data){
        $get = $this->admin;

        return $get->latest()->get();
    }


    public function store($request){
        
        $admin = new Admin;
        $admin->slug = $request->slug;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->position = $request->position;
        $admin->first_name = $request->first_name;
        $admin->middle_name = $request->middle_name;
        $admin->last_name = $request->last_name;
        $admin->username = $request->username;

        $admin->created_at = $this->carbon->now();
        $admin->updated_at = $this->carbon->now();
        $admin->ip_created = request()->ip();
        $admin->ip_updated = request()->ip();
        $admin->user_created = $this->auth->guard('admin')->user()->slug;
        $admin->user_updated = $this->auth->guard('admin')->user()->slug;

        if(!$admin->save()){
            abort(500,'Error saving data.');
        }
        return $admin;
    }




    public function update($request, $slug){

        $admin = $this->findBySlug($slug);

        $admin->email = $request->email;
        $admin->position = $request->position;
        $admin->first_name = $request->first_name;
        $admin->middle_name = $request->middle_name;
        $admin->last_name = $request->last_name;

        $admin->updated_at = $this->carbon->now();
        $admin->ip_updated = request()->ip();
        $admin->user_updated = $this->auth->guard('admin')->user()->slug;

        if(!$admin->save()){
            abort(500,'Error saving data.');
        }
        return $admin;
    }




    public function destroy($slug){

       $admin = $this->findBySlug($slug);
       $admin->delete();
       return $admin;

    }

    public function findBySlug($slug){
        $admin = $this->admin
                ->select('*', DB::raw('CONCAT(first_name, " ", last_name) AS fullname'))
                ->where('slug','=' ,$slug)
                ->first();
        return $admin;
    }
    



    public function getRaw(){
        
    }


    public function currentAdminMenusTree(){
        $slug = $this->auth->guard('admin')->user()->slug;

        $admin = $this->findBySlug($slug);
        
        $admin_tree = ['aaa'=> 'a'];

        
        $admin_tree = $this->menu_repo->allAdminMenusTree();
        $current_admin_tree = [];

        if($admin->admin_functions->count() > 0){

            foreach ($admin->admin_functions as $admin_function) {
                if(!empty($admin_function->masterFunction)){
                    $current_admin_tree[$admin_function->masterFunction->menu->label][$admin_function->masterFunction->menu->menu_name]['functions'][$admin_function->masterFunction->function_name]['function_obj'] = $admin_function->masterFunction;

                    $current_admin_tree[$admin_function->masterFunction->menu->label][$admin_function->masterFunction->menu->menu_name]['menu_obj'] = $admin_function->masterFunction->menu;
                }
                

            }
        }

        // if($admin->admin_functions->count() > 0){

        //     foreach ($admin->admin_functions as $function) {
        //         //$menu_object = $function->masterFunction->menu;
        //         $function_object = $function->masterFunction;
        //         $admin_tree[$function_object->menu->label][$function_object->menu->menu_name][$function_object->function_name] = [
        //             'function_obj' => $function_object
        //         ];
        //         $admin_tree[$function_object->menu->label][$function_object->menu->menu_name]['menu_obj'] = $function_object->menu;





        //         //$admin_tree[$function->function_slug] = 1;
        //     }
        // }
        //$result = array_intersect($admin_tree, $current_admin_tree);
       
        return $current_admin_tree;
        
    }

}