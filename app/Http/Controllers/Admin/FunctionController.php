<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Swep\Services\Admin\MenuService;
use App\Http\Requests\Admin\FunctionFormRequest;
use App\Swep\Services\Admin\FunctionService;
use DataTables;
class FunctionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $menu_service;
    protected $function_service;

    public function __construct(MenuService $menu_service,FunctionService $function_service){
        $this->menu_service = $menu_service;
        $this->function_service = $function_service;
    }

    public function index()
    {   
        if(request()->ajax()){
            //if AJAX is detected coming from datatable
            if(request()->get('type') == "dataTable"){
                $data = request();
                return DataTables::of($this->function_service->fetchTable($data))
                ->addColumn('action', function($data){
                    $button = '<div class="btn-group">
                                    <button type="button" data="'.$data->slug.'" class="btn btn-default btn-sm edit_function_btn" data-toggle="modal" data-target="#edit_function_modal" title="Edit" data-placement="top">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" data="'.$data->slug.'" class="btn btn-sm btn-danger delete_function_btn" data-toggle="tooltip" title="Delete" data-placement="top">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>';
                    return $button;
                })->editColumn('function_is_nav',function($data){
                    if($data->function_is_nav == 1){
                        return '<center><span class="bg-green badge"><i class="fa fa-check"></i></span></center>';
                    }elseif($data->function_is_nav == 0){
                        return '<center><span class="bg-red badge"><i class="fa fa-times"></i></span></center>';
                    }else{
                        return $data->sex;
                    }
                    
                })
                ->editColumn('function_belongs_to',function($data){
                    if($data->function_belongs_to == 'admin'){
                        return '<center><span class="bg-green label">Admin</span></center>';
                    }elseif($data->function_belongs_to == 'user'){
                        return '<center><span class="bg-blue label">User</center>';
                    }else{
                        return $data->function_belongs_to;
                    }
                    
                })
                ->editColumn('function_icon', function($data){
                    return '<center><span><i class="'.$data->function_icon.'"></i></span></center>';
                })         
                ->escapeColumns([])
                ->setRowId('slug')
                ->make(true);
            }
        }



        $slug = request('menu_slug');

        $menu = $this->menu_service->fetch($slug);

        return view('admin.function.index')->with([
            'menu' => $menu,
        ]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FunctionFormRequest $request)
    {   
        return $this->function_service->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {   
        $function = $this->function_service->edit($slug);
        return view('admin.function.edit')->with(['function'=>$function]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FunctionFormRequest $request, $slug)
    {
        return $this->function_service->update($request,$slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        return $this->function_service->destroy($slug);
    }

    public function add_resource(){
        $request = request();
        return $this->function_service->add_resource($request);
    }
}
