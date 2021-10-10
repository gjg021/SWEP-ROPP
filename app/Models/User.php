<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;



class User extends Authenticatable{

    use Notifiable, Sortable;

    public $timestamps = false;
    protected $hidden = ['password', 'remember_token',];


    protected $attributes = [

        'username' => '',
        'password' => '',
        'last_name' => '',
        'first_name' => '',
        'middle_name' => '',
        'phone' => '',
        'email' => '',
        'birthday' => null,
        'street' => '',
        'barangay' => '',
        'city' => '',
        'region' => '',
        'province' => '',
        'business_name' => '',
        'business_tin' => '',
        'business_phone' => '',
        'position' => '',
        'business_street' => '',
        'business_barangay' => '',
        'business_city' => '',
        'is_active' => 1,
        'is_verified' => 1,
        'remember_token' => '',
        'created_at' => '',
        'updated_at' => '',
    ];



    /** RELATIONSHIPS **/ 
    public function userMenu() {
        return $this->hasMany('App\Models\UserMenu','user_id','user_id');
    }

    public function userSubmenu() {
        return $this->hasMany('App\Models\UserSubmenu','user_id','user_id');
    }
    


    /** GETTERS **/
    public function getFullnameShortAttribute(){
        return strtoupper(substr($this->firstname , 0, 1) . ". " . $this->lastname);
    }


    public function getFullnameAttribute(){
        return strtoupper($this->firstname . " " . substr($this->middlename , 0, 1) . ". " . $this->lastname);
    }
    

    public function displayOnlineStatusIcon(){
            
        if ($this->is_online == 1) {
            return '<span class="badge bg-green"><i class="fa fa-check "></i></span>';
        }else{
            return '<span class="badge bg-red"><i class="fa fa-times "></i></span>';
        }

    }
    

    public function displayActiveStatusIcon(){
            
        if ($this->is_active == 1) {
            return '<span class="badge bg-green"><i class="fa fa-check "></i></span>';
        }else{
            return '<span class="badge bg-red"><i class="fa fa-times "></i></span>';
        }

    }



}
