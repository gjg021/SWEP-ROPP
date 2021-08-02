<?php

namespace App\Swep\Repositories\User;
 
use App\Swep\BaseClasses\Admin\BaseRepository;
use App\Swep\Interfaces\User\UserMenuInterface;

use Route;
use App\Models\Admin\Menu;


class UserMenuRepository extends BaseRepository implements UserMenuInterface {
    


    protected $menu;



    public function __construct(Menu $menu){

        $this->menu = $menu;
        parent::__construct();

    }




    public function store($user, $menu){

        // $user_menu = new UserMenu;
        // $user_menu->user_menu_id = $this->getUserMenuIdInc();
        // $user_menu->user_id = $user->user_id;
        // $user_menu->menu_id = $menu->menu_id;
        // $user_menu->name = $menu->name;
        // $user_menu->route = $menu->route;
        // $user_menu->icon = $menu->icon;
        // $user_menu->is_menu = $menu->is_menu;
        // $user_menu->is_dropdown = $menu->is_dropdown; 
        // $user_menu->save();

        // return $user_menu;
        
    }




    public function getUserMenuIdInc(){

        // $id = 'UM10000001';
        // $usermenu = $this->user_menu->select('user_menu_id')->orderBy('user_menu_id', 'desc')->first();

        // if($usermenu != null){
        //     if($usermenu->user_menu_id != null){
        //         $num = str_replace('UM', '', $usermenu->user_menu_id) + 1;
        //         $id = 'UM' . $num;
        //     }
        // }
        
        // return $id;
        
    }




    public function getAll(){

        // $user_menus = $this->cache->remember('user_menus:getAll:'. $this->auth->user()->user_id .'', 240, function(){
        //   return $this->user_menu->where('user_id', $this->auth->user()->user_id)
        //                          ->with('userSubMenu')
        //                          ->get();
        // });

        // return $user_menus;
        
    }

    public function getCurrentUserMenus(){
        $menus = $this->menu->where('belongs_to','=','user')->get();

        $user_menus = [];
        foreach ($menus as $menu) {
            $user_menus[$menu->label][$menu->slug]['functions'] = [];
            $user_menus[$menu->label][$menu->slug]['menu_obj'] = $menu;
            if($menu->functions->count() > 0){
                foreach ($menu->functions as $function) {
                    if($function->function_belongs_to == 'user'){
                        $user_menus[$menu->label][$menu->slug]['functions'][$function->function_name] = [];
                        $user_menus[$menu->label][$menu->slug]['functions'][$function->function_name]['function_obj'] = $function;
                    }
                }
            }
            
        }
        
        return $user_menus;
    }


    public function isExist() {

    }




}