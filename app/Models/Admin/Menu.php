<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Menu extends Model{





    use Sortable;

    protected $table = 'su_menus';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;





    protected $attributes = [

        'slug' => '',
        'menu_name' => '',
        'label' => '',
        'route' => '',
        'icon' => '',
        'is_nav' => false,
        'is_dropdown' => false,
        'order' => null,
        'belongs_to' => '',
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];





    /** RELATIONSHIPS **/
    // public function user() {
    // 	return $this->belongsTo('App\Models\Admin','user_id','user_id');
   	// }

    public function functions(){
        return $this->hasMany('App\Models\Admin\Functions', 'menu_slug', 'slug');
    }


    // public function submenu() {
    // 	return $this->hasMany('App\Models\Submenu','menu_id','menu_id');
   	// }

    





}
