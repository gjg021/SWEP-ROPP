<?php
 
namespace App\Swep\Services\Admin;


use App\Swep\BaseClasses\Admin\BaseService;
use App\Swep\Repositories\Admin\MenuRepository;


class MenuService extends BaseService{



    protected $menu_repo;


    public function __construct(MenuRepository $menu_repo){

        // $this->applicant_repo = $applicant_repo;
        // $this->course_repo = $course_repo;
        // $this->dept_unit_repo = $dept_unit_repo;
        $this->menu_repo = $menu_repo;
        //parent::__construct();

    }


    public function fetchTable($data){
        return $this->menu_repo->fetchTable($data);
    }



    public function fetch($slug){
        return $this->menu_repo->fetch($slug);

    }






    public function store($request){

        return $this->menu_repo->store($request);
        // $applicant = $this->applicant_repo->store($request);
        // $this->fillDependencies($request, $applicant);

        // $this->event->fire('applicant.store', $applicant);
        // return redirect()->back();

    }






    public function show($slug){

        // $applicant = $this->applicant_repo->findBySlug($slug);
        // return view('dashboard.applicant.show')->with('applicant', $applicant);

    }






    public function edit($slug){

        return $this->menu_repo->findBySlug($slug);

    }





    public function update($request, $slug){

        return $this->menu_repo->update($request,$slug);

    }





    public function destroy($slug){

        return $this->menu_repo->destroy($slug);

    }


    public function getRaw(){
        return $this->menu_repo->getRaw();
    }







}