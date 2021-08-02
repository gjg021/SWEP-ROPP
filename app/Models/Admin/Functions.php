<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Functions extends Model{





    use Sortable;

    protected $table = 'su_functions';


    
	public $timestamps = false;





    protected $attributes = [

        'slug' => '',
        'function_name' => '',
        'function_route' => '',
        'function_label' => '',
        'function_is_nav' => '',

    ];





    /** RELATIONSHIPS **/
    // public function user() {
    // 	return $this->belongsTo('App\Models\Admin','user_id','user_id');
   	// }

    public function menu(){
        return $this->belongsTo('App\Models\Admin\Menu', 'menu_slug', 'slug');
    }


    // public function submenu() {
    // 	return $this->hasMany('App\Models\Submenu','menu_id','menu_id');
   	// }

    





}
