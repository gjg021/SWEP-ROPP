<?php


namespace App\Models\User;


use Illuminate\Database\Eloquent\Model;
class SupportingDocuments extends Model
{
    protected $table = 'supporting_documents';
    //protected $primaryKey = 'slug';
    public $timestamps = false;

    public function orderOfPayment(){
        return $this->belongsTo('App\Models\User\OrderOfPayments','transaction_id','slug');
    }
}