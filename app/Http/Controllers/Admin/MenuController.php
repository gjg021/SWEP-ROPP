<?php

namespace App\Http\Controllers\Admin;


use App\Swep\Services\Admin\MenuService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MenuFormRequest;
use Yajra\DataTables\DataTables;


class MenuController extends Controller
{

    protected $menu_service;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(MenuService $menu_service){

        $this->menu_service = $menu_service;
    }


    public function index()
    {
        if(request()->ajax())
        {   
            $data = request();

            return DataTables::of($this->menu_service->fetchTable($data))
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
            })->editColumn('is_nav',function($data){
                if($data->is_nav == 1){
                    return '<center><span class="bg-green badge"><i class="fa fa-check"></i></span></center>';
                }elseif($data->is_nav == 0){
                    return '<center><span class="bg-red badge"><i class="fa fa-times"></i></span></center>';
                }else{
                    return $data->is_nav;
                }
                
            })
            ->editColumn('is_dropdown',function($data){
                if($data->is_dropdown == 1){
                    return '<center><span class="bg-green badge"><i class="fa fa-check"></i></span></center>';
                }elseif($data->is_dropdown == 0){
                    return '<center><span class="bg-red badge"><i class="fa fa-times"></i></span></center>';
                }else{
                    return $data->sex;
                }
                
            })
            ->editColumn('functions', function($data){
                $return = '';
                if($data->functions->count() > 0){
                    foreach ($data->functions as $function) {
                        $return = $return.' | '.$function->function_name;
                    }
                }
                return substr_replace($return ,"", 0 ,2);;
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
            ->escapeColumns([])
            ->setRowId('slug')
            ->make(true);
        }
        return view('admin.menu.index');
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
    public function store(MenuFormRequest $request)
    {

        return $this->menu_service->store($request);
        return $request;
        return 'storing';
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
        $menu = $this->menu_service->edit($slug);
        return view('admin.menu.edit')->with(['menu'=>$menu]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuFormRequest $request,$slug)
    {
        return $this->menu_service->update($request, $slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        return $this->menu_service->destroy($slug);
    }
}
