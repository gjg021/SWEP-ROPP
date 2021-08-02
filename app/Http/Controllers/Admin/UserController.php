<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Swep\Services\User\UserService;
use DataTables;

class UserController extends Controller
{   
    protected $user_service;
    public function __construct(UserService $user_service){
        $this->user_service = $user_service;
    }

    public function index()
    {   
        if(request()->ajax())
        {   
            $data = request();

            return DataTables::of($this->user_service->fetchTable($data))
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
            })->editColumn('is_active',function($data){
                if($data->is_active == 1){
                    return '<center><span class="bg-green badge"><i class="fa fa-check"></i></span></center>';
                }elseif($data->is_active == 0){
                    return '<center><span class="bg-red badge"><i class="fa fa-times"></i></span></center>';
                }else{
                    return $data->is_active;
                }
                
            })
            ->editColumn('is_verified',function($data){
                if($data->is_verified == 1){
                    return '<center><span class="bg-green badge"><i class="fa fa-check"></i></span></center>';
                }elseif($data->is_verified == 0){
                    return '<center><span class="bg-red badge"><i class="fa fa-times"></i></span></center>';
                }else{
                    return $data->is_verified;
                }
                
            })
            ->editColumn('functions', function($data){
               'a';
            }) 
            ->editColumn('icon', function($data){
                return '<center><span><i class="fa '.$data->icon.'"></i></span></center>';
            }) 
            ->editColumn('belongs_to', function($data){
                if($data->belongs_to == 'user'){
                    return '<p class="label bg-blue">'.strtoupper($data->belongs_to).'</p>' ;
                }
                if($data->belongs_to == 'admin'){
                    return '<p class="label bg-green">'.strtoupper($data->belongs_to).'</p>' ;
                }
                return '<p class="label bg-yellow">'.strtoupper($data->belongs_to).'</p>' ;
                
            })
            ->editColumn('full_name', function($data){
                return $data->last_name.', '.$data->first_name;
                
            })        
            ->escapeColumns([])
            ->setRowId('slug')
            ->make(true);
        }
        return view('admin.user.index');
    }

    
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}
