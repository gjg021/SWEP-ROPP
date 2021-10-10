<?php

namespace App\Http\Requests\User;


use Illuminate\Foundation\Http\FormRequest;


class UserFormRequest extends FormRequest{
    public function authorize(){
        return true;
    }

    public function rules(){

        $rules = [
            
            'first_name'=>'required|string|max:45',
            'middle_name'=>'required|string|max:45',
            'last_name'=>'required|string|max:45',
            'sex'=>'required|string|max:45',
            'birthday'=>'required|date|max:45',
            'phone'=>'required|string|max:45',
            'region'=>'required|string|max:45',
            'province'=>'required|string|max:45',
            'municipality'=>'required|string|max:45',
            'barangay'=>'required|string|max:45',
            'address'=>'nullable|string|max:45',
            'email'=>'required|string|email|max:45|unique:users,email',
            'business_name' => 'required|string|max:99',
            'business_tin' => 'required|int|max:999999999999',
            'business_phone' => 'required|string|max:45',
//           'username'=>'required|string|max:45|unique:users,username',
            'password'=>'sometimes|required|string|min:6|max:45|same:password_confirmation',
            'password_confirmation'=>'sometimes|required|string|min:6|max:45|same:password',
        ];



        return $rules;

    }





}
