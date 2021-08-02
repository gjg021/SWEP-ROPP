<?php

namespace App\Models\User;

use Auth;
use Route;

use Illuminate\Database\Eloquent\Model;



class UserEmailVerification extends Model{





    protected $table = 'user_email_verification';
    protected $hidden = ['verification_slug','user_slug'];
    public $timestamps = false;
    



    protected $attributes = [

        'user_slug' => '',
        'verification_slug' => '',
        'created_at' => null,

    ];



	// /** RELATIONSHIPS **/
	// public function user() {
 //      return $this->belongsTo('App\Models\User','user_id','user_id');
 //    }



 //    public function userSubmenu() {
 //    	return $this->hasMany('App\Models\UserSubmenu','user_menu_id','user_menu_id');
 //   	}







}
