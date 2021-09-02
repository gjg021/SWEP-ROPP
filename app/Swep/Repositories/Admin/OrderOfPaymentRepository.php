<?php

namespace App\Swep\Repositories\Admin;

use App\Models\User\OrderOfPayments;
use App\Swep\BaseClasses\Admin\BaseRepository;
use App\Swep\Interfaces\Admin\MenuInterface;

use App\Models\Admin\Menu;
use App\Swep\Interfaces\Admin\OrderOfPaymentInterface;
use Auth;

class OrderOfPaymentRepository extends BaseRepository implements OrderOfPaymentInterface {


    protected $op;


    public function __construct(OrderOfPayments $op){
        parent::__construct();
        $this->op = $op;
    }

    public function fetch($slug){

    }

    public function fetchTable($data){
        $get = $this->op->with('user');
        return $get;
    }

    public function store($request){

    }

    public function update($id){
        $op = OrderOfPayments::where('slug',$id)->first();
        $op->status = "PAID";
        $op->save();
        return $op;
    }

    public function destroy($slug){

    }

    public function findBySlug($slug){

    }

    public function getRaw(){
        return 2;

    }

    public function allAdminMenusTree(){
    }

}