<?php


namespace App\Swep\Repositories\User;


use App\Models\User\SucroseContentModel;
use App\Swep\BaseClasses\Admin\BaseRepository;

class SucroseContentRepository extends BaseRepository
{
    protected $sucroseContent;
    public function __construct(SucroseContentModel $sucroseContent){
        $this->sucroseContent = $sucroseContent;
        parent::__construct();
    }
}