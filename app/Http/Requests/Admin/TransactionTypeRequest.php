<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class TransactionTypeRequest extends FormRequest{

    public function authorize(){

        return true;
    }

    public function rules(){
        return [
            'name' => 'required|string|max:180',
            'group' => 'required|string|max:16',
            'unit' => 'required|string|max:16',
            //feePerUnit' => 'double',
            //'regularFee' => 'double',
            //'expediteFee' => 'double',
        ];
    }
}