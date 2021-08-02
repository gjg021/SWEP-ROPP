<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MenuFormRequest extends FormRequest{

    
    public function authorize(){

        return true;
    }

   
    public function rules(){

        return [

            'menu_name' => 'required|string|max:45',
            'menu_route' => 'required|string|max:45',
            'menu_icon' => 'required|string|max:45',
            'menu_label' => 'nullable',
            'menu_is_nav' => 'required|int|max:1',
            'menu_is_dropdown' => 'required|int|max:1'

        ];

    }




}