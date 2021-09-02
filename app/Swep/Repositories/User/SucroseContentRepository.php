<?php


namespace App\Swep\Repositories\User;


use App\Models\User\SucroseContentModel;
use App\Swep\BaseClasses\Admin\BaseRepository;
use App\Swep\Interfaces\Admin\SucroseInterface;

class SucroseContentRepository extends BaseRepository implements SucroseInterface
{
    protected $sucroseContent;

    public function __construct(SucroseContentModel $sucroseContent){
        $this->sucroseContent = $sucroseContent;
        parent::__construct();
    }

    public function fetch($slug){

//        $menu = $this->menu;
//
//        return $menu->where('slug','=',$slug)->first();

    }

    public function fetchTable($data){
        $get = $this->sucroseContent->get();
        return $get;
    }


    public function store($request){

    }

    public function update($request, $slug){

    }

    public function destroy($slug){

    }

    public function findBySlug($slug){
    }

    public function getRaw(){
        return 2;
    }


}