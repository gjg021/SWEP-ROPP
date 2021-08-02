<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;



class Admin extends Authenticatable{


    use Notifiable, Sortable;

    protected $guard = 'admin';

    protected $dates = ['created_at', 'updated_at', 'last_login_time'];
    public $sortable = ['username', 'firstname', 'is_online', 'is_active'];
    public $timestamps = false;
    protected $hidden = ['password', 'remember_token',];
    protected $fillable = ['slug'];


    protected $attributes = [

        // 'slug' => '',
        'email' => '', 
        'username' => '', 
        'password' => '', 
        'slug' => '',
        'last_name' => '', 
        'middle_name' => '', 
        'first_name' => '', 
        'position' => '', 
        'is_activated' => 0,
        // 'is_online' => false, 
        // 'is_active' => false,
        'color' => 'skin-green sidebar-mini', 
        'created_at' => null, 
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',
        // 'last_login_time' => null,
        // 'last_login_machine' => '',
        // 'last_login_ip' => '',

    ];


    public function admin_functions(){
        return $this->hasMany('App\Models\Admin\AdminFunctions','admin_slug','slug');
    }

    // public function admin_menu(){
    //     return $this->hasOneThrough(
    //         'App\Models\Admin\Menu',
    //         'App\Models\Admin\AdminFunctions',
    //         'function_slug',
    //         'slug',
    //         'slug',
    //         'admin_slug'
    //     );
    // }

    // /** RELATIONSHIPS **/ 
    // public function userMenu() {
    //     return $this->hasMany('App\Models\UserMenu','user_id','user_id');
    // }

    // public function userSubmenu() {
    //     return $this->hasMany('App\Models\UserSubmenu','user_id','user_id');
    // }
    


    // /** GETTERS **/
    // public function getFullnameShortAttribute(){
    //     return strtoupper(substr($this->firstname , 0, 1) . ". " . $this->lastname);
    // }


    // public function getFullnameAttribute(){
    //     return strtoupper($this->firstname . " " . substr($this->middlename , 0, 1) . ". " . $this->lastname);
    // }
    

    // public function displayOnlineStatusIcon(){
            
    //     if ($this->is_online == 1) {
    //         return '<span class="badge bg-green"><i class="fa fa-check "></i></span>';
    //     }else{
    //         return '<span class="badge bg-red"><i class="fa fa-times "></i></span>';
    //     }

    // }
    

    // public function displayActiveStatusIcon(){
            
    //     if ($this->is_active == 1) {
    //         return '<span class="badge bg-green"><i class="fa fa-check "></i></span>';
    //     }else{
    //         return '<span class="badge bg-red"><i class="fa fa-times "></i></span>';
    //     }

    // }



}
