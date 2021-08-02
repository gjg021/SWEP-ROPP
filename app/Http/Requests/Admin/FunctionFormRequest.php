<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FunctionFormRequest extends FormRequest{

    
    public function authorize(){

        return true;
    }

   
    public function rules(){

        return [

            'function_name' => 'required|string|max:45',
            'function_route' => 'required|string|max:255',
            'function_label' => 'nullable',
            'function_is_nav' => 'required|int|max:1',
            'function_belongs_to' => 'required|string|max:45',
            // 'menu_slug' => 'required|string|max:45',
        ];

    }




}