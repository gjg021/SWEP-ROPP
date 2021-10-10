<?php


namespace App\Swep\Repositories\Admin;

use App\Models\User\PreRegistrationModel;
use App\Models\User\TransactionType;
use App\Swep\BaseClasses\Admin\BaseRepository;
use App\Swep\Interfaces\Admin\PreRegistrationInterface;
use App\Swep\Interfaces\Admin\TransactionTypeInterface;

class TransactionTypeRepository extends BaseRepository implements TransactionTypeInterface{
    protected $transactionType;

    public function __construct(TransactionType $transactionType)
    {
        $this->transactionType = $transactionType;
        parent::__construct();
    }

    public function fetchTable($data){
        $get = $this->transactionType;
        return $get->all();
    }

    public function fetch($request)
    {
        // TODO: Implement fetch() method.
    }

    public function store($request)
    {
        // TODO: Implement store() method.
    }

    public function update($request, $slug)
    {
        // TODO: Implement update() method.
    }

    public function destroy($slug)
    {
        // TODO: Implement destroy() method.
    }
}