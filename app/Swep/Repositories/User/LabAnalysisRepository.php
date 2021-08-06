<?php


namespace App\Swep\Repositories\User;


use App\Models\User\LabAnalysis;
use App\Swep\BaseClasses\Admin\BaseRepository;

class LabAnalysisRepository extends BaseRepository
{
    protected $labAnalysis;
    public function __construct(LabAnalysis $labAnalysis)
    {
        $this->labAnalysis = $labAnalysis;
        parent::__construct();
    }

    public function findBySlug($slug) {
        $labAnalysis = $this->labAnalysis->where('slug', '=', $slug)->first();
        return $labAnalysis;
    }
}