<?php
 
namespace App\Swep\Services\Admin;


use App\Swep\BaseClasses\Admin\BaseService;
use App\Swep\Repositories\Admin\FunctionRepository;


class FunctionService extends BaseService{



    protected $function_repo;
    // protected $function_repo;

    public function __construct(FunctionRepository $function_repo){

        $this->function_repo = $function_repo;
        //parent::__construct();

    }


    public function fetchTable($data){
        return $this->function_repo->fetchTable($data);
    }



    public function fetch($slug){
  

    }






    public function store($request){
        return $this->function_repo->store($request);

    }






    public function show($slug){

    

    }






    public function edit($slug){

      return $this->function_repo->findBySlug($slug);

    }





    public function update($request, $slug){

        return $this->function_repo->update($request,$slug);

    }





    public function destroy($slug){

      return $this->function_repo->destroy($slug);
      

    }


    public function add_resource($request){

        $resources = $this->resources();
        

        foreach ($resources as $name => $route) {
            $req = collect();
            $req->menu_slug = $request->menu_slug;
            $req->function_name = $name;
            $req->function_icon = '';
            //$req->function_belongs_to = 'admin';
            $req->function_label = '';
            $req->function_is_nav = 0;
            if($route == 'index'){
                $req->function_label = 'Manage';
                $req->function_is_nav = 1;
            }

            $req->function_route = str_replace('*', $route , $request->main_route);
            
            $this->function_repo->store($req);
        }


        return 1;
    }

    private function resources(){
        $resources = [
            'Index' => 'index',
            'Store' => 'store',
            'Edit' => 'edit',
            'Update' => 'update',
            'Show' => 'show',
            'Destroy' => 'destroy',
        ];
        return $resources;
    }






}