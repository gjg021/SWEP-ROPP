<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\TransactionTypeRequest;
use App\Models\User\TransactionType;
use App\Swep\Repositories\Admin\TransactionTypeRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
class TransactionTypeController extends Controller
{

    protected $transactionTypeRepo;
    public function __construct(TransactionTypeRepository $transactionTypeRepo)
    {
        $this->transactionTypeRepo = $transactionTypeRepo;
    }

    public function index(){
        if(request()->ajax())
        {
            $data = request();
            return DataTables::of($this->transactionTypeRepo->fetchTable($data))
                ->addColumn('action', function($data){
                    $button = '<div class="btn-group">
                                <button type="button" data="'.$data->slug.'" class="btn btn-default btn-sm edit_btn" data-toggle="modal" data-target="#edit_modal" title="Edit" data-placement="top">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" data="'.$data->slug.'" class="btn btn-sm btn-danger delete_btn" data-toggle="tooltip" title="Delete" data-placement="top">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>';
                    return $button;
                })
                ->escapeColumns([])
                ->setRowId('slug')
//                ->make(true)
                ->toJson();
        }
        return view('admin.transactionType.index');
    }

    public function edit($slug)
    {
        $transaction_type_db = TransactionType::where('slug', '=', $slug)->first();
        return view('admin.transactionType.edit')->with(['transactionType' => $transaction_type_db]);
    }

    public function update(TransactionTypeRequest $request, $slug) {
        $transaction_type_db = TransactionType::where('slug', '=', $slug)->first();
        $transaction_type_db->name = $request->name;
        $transaction_type_db->transaction_types_group_slug = $request->group;
        $transaction_type_db->unit = $request->unit;
        $transaction_type_db->fee_per_unit = $request->feePerUnit;
        $transaction_type_db->regular_fee = $request->regularFee;
        $transaction_type_db->expedite_fee = $request->expediteFee;
        $transaction_type_db->save();
    }

    public function destroy($slug) {
        $transaction_type_db = TransactionType::where('slug', '=', $slug)->first();
        $transaction_type_db->destroy();
    }

    public function store(Request $request) {
        $transaction_type = new TransactionType();
        $transaction_type->slug = $request->slug;
        $transaction_type->name = $request->name;
        $transaction_type->transaction_types_group_slug = $request->group;
        $transaction_type->unit = $request->unit;
        $transaction_type->fee_per_unit = $request->feePerUnit;
        $transaction_type->regular_fee = $request->regularFee;
        $transaction_type->expedite_fee = $request->expediteFee;
        $transaction_type->save();
    }
}
