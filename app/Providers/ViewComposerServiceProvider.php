<?php

namespace App\Providers;


use View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider{

    
    public function boot(){

        /** VIEW COMPOSERS  **/


        // USERMENU
        // View::composer('layouts.admin-sidenav', 'App\Core\ViewComposers\UserMenuComposer');


        // // MENU
        // View::composer(['dashboard.user.create', 
        //                 'dashboard.user.edit'], 'App\Core\ViewComposers\MenuComposer');
        

        // // SUBMENU
        // View::composer(['dashboard.user.create', 
        //                 'dashboard.user.edit'], 'App\Core\ViewComposers\SubmenuComposer');


        //ADMINMENUS
        View::composer('admin-layouts.side-nav','App\Swep\ViewComposers\AdminMenuComposer');
        
        //USERMENUS
        View::composer('layouts.admin-sidenavs','App\Swep\ViewComposers\UserMenuComposer');


    }

    




    
    public function register(){

      


    
    }




}
