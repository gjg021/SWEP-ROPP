<?php


namespace App\Http\Requests\User;


use Illuminate\Foundation\Http\FormRequest;

class PaymentFormRequest extends FormRequest
{
    public function authorize(){

        return true;

    }
    public function rules(){

        $rules = [
            'transaction_code'=>'required|string|max:45',
            'payment_method'=>'required|string|max:45',
            'amount'=>'required|between:0.01,1000000.00',
        ];
        return $rules;

    }
}