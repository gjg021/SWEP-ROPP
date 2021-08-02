<?php


namespace App\Models\User;


use Illuminate\Database\Eloquent\Model;

class TransactionType extends  Model
{
    protected $table = 'su_transaction_types';
    public $timestamps = false;

    public function documentaryRequirements(){
        return $this->hasMany('App\Models\User\DocumentaryRequirements','transaction_type','transaction_code');
    }

}