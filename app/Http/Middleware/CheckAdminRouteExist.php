<?php

namespace App\Http\Middleware;

use Closure;
use App\Swep\Repositories\Admin\AdminFunctionsRepository;
use Auth;
class CheckAdminRouteExist{



    protected $admin_functions_repo;



    public function __construct(AdminFunctionsRepository $admin_functions_repo){

        $this->admin_functions_repo = $admin_functions_repo;
        
    }
  




    public function handle($request, Closure $next){

        // if($this->user_menu_repo->isExist() || $this->user_submenu_repo->isExist()){

        //     return $next($request);

        // }
        if(Auth::guard('admin')->check()){
            if($this->admin_functions_repo->checkRouteExists() == true){
                return $next($request);    
            }

            return abort(404);
        }else{
            return redirect(route('admin.login'));
            
        }
        
        
       
    
    }





}
