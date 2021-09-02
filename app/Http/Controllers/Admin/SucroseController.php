<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Swep\Repositories\User\SucroseContentRepository;
use DataTables;
class SucroseController extends Controller
{
    public function __construct(SucroseContentRepository $suc_repo)
    {
        $this->suc_repo = $suc_repo;
    }

    public function index(){
        if(request()->ajax())
        {
            $data = request();
            return DataTables::of($this->suc_repo->fetchTable($data))
                ->addColumn('action', function($data){
                    $button = '<div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm functions_index_btn" data="'.$data->slug.'" data-toggle="modal" data-target ="#functions_index_modal" title="Functions" data-placement="left">
                                    <i class="fa fa-list"></i>
                                </button>
                                <button type="button" data="'.$data->slug.'" class="btn btn-default btn-sm edit_menu_btn" data-toggle="modal" data-target="#edit_menu_modal" title="Edit" data-placement="top">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" data="'.$data->slug.'" class="btn btn-sm btn-danger delete_menu_btn" data-toggle="tooltip" title="Delete" data-placement="top">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>';
                    return $button;
                })
                //->addColumn('status',function ($data){
                 //   if($data->expires_on <= Carbon::now()){
                 ////       return '<div class="label bg-red">Expired</div>';
                //    }else{
                //        return '<div class="label bg-green">To Pay</div>';
                //    }
               // })
                ->editColumn('slug',' <p style="font-family:Consolas,monospace; font-size:115%">{{$slug}}</p>')
                ->editColumn('base_percentage', function ($data){
                    return $data->base_percentage;
                })
                ->editColumn('below_price',function($data){
                    return $data->below_price;
                })
                ->editColumn('above_price',function($data){
                    return $data->above_price;
                })
                ->editColumn('zero_content',function($data){
                    return $data->zero_content;
                })
                ->escapeColumns([])
                ->setRowId('slug')
//                ->make(true)
                ->toJson();
        }
        return view('admin.sucrose.index');
    }
}