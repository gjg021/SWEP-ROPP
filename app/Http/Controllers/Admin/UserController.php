<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Swep\Services\User\UserService;
use App\Swep\Services\Admin\MenuService;
use DataTables;
use Hash;
use Validator;

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

    public function new_slug(){

        $slug = rand(10000000,99999999);

        $validator = Validator::make(['slug'=> $slug],
            [
                'slug' => 'required|unique:users,slug',
            ]
        );

        if ($validator->fails()) {
            return 0;
        }

        return $slug;
    }

    public function store(Request $request)
    {
        $user = new User();
        $user->slug = $this->new_slug();
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->last_name = $request->lastName;
        $user->first_name = $request->firstName;
        $user->middle_name = $request->middleName;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->birthday = $request->birthday;
        $user->street = $request->street;
        $user->barangay = $request->barangay;
        $user->city = $request->city;
        $user->business_name = $request->businessName;
        $user->business_tin = $request->businessTin;
        $user->business_phone = $request->businessPhone;
        $user->position = $request->position;
        $user->business_street = $request->business_street;
        $user->business_barangay = $request->business_barangay;
        $user->business_city = $request->business_city;
        $user->is_active = true;
        $user->is_verified = true;
        $user->created_at = Carbon::now();
        $user->updated_at = Carbon::now();
        $user->save();
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
