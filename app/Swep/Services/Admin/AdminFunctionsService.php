<?php
 
namespace App\Swep\Services\Admin;


use App\Swep\BaseClasses\Admin\BaseService;
use App\Swep\Repositories\Admin\AdminFunctionsRepository;
use Illuminate\Http\Request;
use Validator;


class AdminFunctionsService extends BaseService{




    protected $admin_functions_repo;

    public function __construct(AdminFunctionsRepository $admin_functions_repo){


        $this->admin_functions_repo = $admin_functions_repo;


    }


    public function fetchTable($data){
       
    }



    public function fetch($slug){
        
        

    }


    public function fetchByAdminSlug($slug,$type = null){
        $admin_functions = $this->admin_functions_repo->fetchByAdminSlug($slug);

        if($type == 'array'){
            $admin_functions_array = [];

            foreach ($admin_functions as $admin_function) {
                array_push($admin_functions_array, $admin_function->function_slug);
            }
            return $admin_functions_array;
        }
        return $this->admin_functions_repo->fetchByAdminSlug($slug);
    }



    public function store($request){


        
    }

    public function show($slug){

    

    }






    public function edit($slug){

      

    }





    public function update($request, $slug){

        


    }





    public function destroy($slug){

      

    }


    public function new_slug(){


        // $request->request->add(['slug' => 531140611]);

        // $validated = $request->validate([
        //     'slug' => 'required|unique:admins,slug',
        // ]);
        $slug = rand(100000000,999999999);

        $validator = Validator::make(['slug'=> $slug], 
                [
                    'slug' => 'required|unique:admins,slug',
                ]
            );

            if ($validator->fails()) {
                return 0;
            }

            return $slug;
    }



    public function test(){
        return $this->admin_functions_repo->checkRouteExists();
    }



}