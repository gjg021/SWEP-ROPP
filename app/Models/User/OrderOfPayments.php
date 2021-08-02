<?php


namespace App\Models\User;


use Illuminate\Database\Eloquent\Model;

class OrderOfPayments extends Model
{
    protected $table = 'order_of_payments';
    //protected $primaryKey = 'slug';
    protected $keyType = 'string';
    public $timestamps = ['created_at'];


    public function supportingDocuments(){
        return $this->hasMany('App\Models\User\SupportingDocuments','transaction_id','slug');
    }

    public function user(){
        return $this->belongsTo('App\Models\User','user_created','slug');
    }
}