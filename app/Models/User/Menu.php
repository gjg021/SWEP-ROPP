<?php

namespace App\Models\User;

use Auth;
use Route;
use Cache;
use Illuminate\Database\Eloquent\Model;



class Menu extends Model{





    protected $table = 'su_user_menus';
    
    public $timestamps = false;
    



    protected $attributes = [

        'user_id' => '',
        'menu_id' => '',
        'user_menu_id' => '',
        'name' => '',
        'route' => '',
        'icon' => '',
        'is_menu' => false,
        'is_dropdown' => false,

    ];



	/** RELATIONSHIPS **/
	public function user() {
      return $this->belongsTo('App\Models\User','user_id','user_id');
    }



    public function userSubmenu() {
    	return $this->hasMany('App\Models\UserSubmenu','user_menu_id','user_menu_id');
   	}







}
