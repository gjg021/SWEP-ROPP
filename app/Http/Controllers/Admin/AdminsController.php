<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Swep\Services\Admin\MenuService;
use App\Swep\Services\Admin\AdminService;
use App\Swep\Services\Admin\AdminFunctionsService;
use App\Http\Requests\Admin\AdminFormRequest;
use DataTables;

class AdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $menu_service;
    protected $admin_service;
    protected $admin_functions_service;

    public function __construct(MenuService $menu_service, AdminService $admin_service, AdminFunctionsService $admin_functions_service){
        $this->menu_service = $menu_service;
        $this->admin_service = $admin_service;
        $this->admin_functions_service = $admin_functions_service;
    }

    public function index()
    {
        if(request()->ajax())
        {   
            $data = request();

            return DataTables::of($this->admin_service->fetchTable($data))
            ->addColumn('action', function($data){
                $button = '<div class="btn-group">
                                <button type="button" class="btn btn-default btn-sm functions_index_btn" data="'.$data->slug.'" data-toggle="modal" data-target ="#functions_index_modal" title="Functions" data-placement="left">
                                    <i class="fa fa-list"></i>
                                </button>
                                <button type="button" data="'.$data->slug.'" class="btn btn-default btn-sm edit_admin_btn" data-toggle="modal" data-target="#edit_admin_modal" title="Edit" data-placement="top">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <button type="button" data="'.$data->slug.'" class="btn btn-sm btn-danger delete_admin_btn" data-toggle="tooltip" title="Delete" data-placement="top">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>';
                return $button;
            })
            ->editColumn('is_activated',function($data){
                if($data->is_activated == 1){
                    return '<center><span class="bg-green badge"><i class="fa fa-check"></i></span></center>';
                }elseif($data->is_activated == 0){
                    return '<center><span class="bg-red badge"><i class="fa fa-times"></i></span></center>';
                }else{
                    return $data->sex;
                }
                
            })
            ->editColumn('fullname', function($data){
                return $data->first_name.' '.$data->middle_name.' '.$data->last_name;
            })         
            ->escapeColumns([])
            ->setRowId('slug')
            ->make(true);
        }

        $menus = $this->menu_service->getRaw();
        return view('admin.admins.index')->with(['menus'=> $menus]);
    }

    public function create()
    {
        
    }

    public function store(AdminFormRequest $request)
    {
        return $this->admin_service->store($request);
    }
    
    public function show($id)
    {
        //
    }

    public function edit($slug)
    {
        $admin = $this->admin_service->fetch($slug);
        $menus = $this->menu_service->getRaw();
        $admin_functions = $this->admin_functions_service->fetchByAdminSlug($slug,'array');
    
        return view('admin.admins.edit')->with([
            'admin'=> $admin,
            'menus' => $menus,
            'admin_functions' => $admin_functions,
        ]);
    }

    public function update(AdminFormRequest $request, $slug)
    {
        return $this->admin_service->update($request,$slug);
    }

    public function destroy($slug)
    {
        return $this->admin_service->destroy($slug);
    }

    public function test(){
        return $this->admin_functions_service->test();
    }
}
