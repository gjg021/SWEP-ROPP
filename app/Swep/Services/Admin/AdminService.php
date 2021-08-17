<?php
 
namespace App\Swep\Services\Admin;


use App\Swep\BaseClasses\Admin\BaseService;
use App\Swep\Repositories\Admin\AdminRepository;
use App\Swep\Repositories\Admin\AdminFunctionsRepository;
use Illuminate\Http\Request;
use Validator;


class AdminService extends BaseService{

    protected $admin_repo;
    protected $admin_functions_repo;

    public function __construct(AdminRepository $admin_repo,AdminFunctionsRepository $admin_functions_repo){

        // $this->applicant_repo = $applicant_repo;
        // $this->course_repo = $course_repo;
        // $this->dept_unit_repo = $dept_unit_repo;
        $this->admin_repo = $admin_repo;
        $this->admin_functions_repo = $admin_functions_repo;
        //parent::__construct();

    }

    public function fetchTable($data){
        return $this->admin_repo->fetchTable($data);
    }

    public function fetch($slug){
        
        return $this->admin_repo->findBySlug($slug);

    }

    public function store($request){

        $new_slug = $this->new_slug();
        while ($new_slug == 0) {
            $new_slug = $this->new_slug();
        }

        $request->request->add(['slug' => $new_slug]);
        $admin = $this->admin_repo->store($request);


        //STORE FUNCTIONS
        foreach ($request->menus as $menu => $functions) {
           foreach ($functions as $function) {
                $req = collect();

                $req->admin_slug = $admin->slug;
                $req->function_slug = $function;

                $this->admin_functions_repo->store($req);
           }
        }
        
        return $admin;
    }

    public function show($slug){

    }

    public function edit($slug){

    }

    public function update($request, $slug){

        $admin = $this->admin_repo->update($request,$slug);

        $admin->admin_functions()->delete();

        if(empty($request->menus)){
            abort(500, 'You have not selected any menu or function for this user');
        }else{
            foreach ($request->menus as $menu => $functions) {
               foreach ($functions as $function) {
                    $req = collect();

                    $req->admin_slug = $admin->slug;
                    $req->function_slug = $function;

                    $this->admin_functions_repo->store($req);
               }
            }
        }

        return $admin;

    }

    public function destroy($slug){

      $admin = $this->admin_repo->destroy($slug);
      if($admin){

        $admin->admin_functions()->delete();
        
        return 1;
      }

      return -1;
    }

    public function new_slug(){

        $slug = rand(10000000,99999999);

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

}