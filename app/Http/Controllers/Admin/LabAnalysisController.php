<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class LabAnalysisController extends Controller
{	

    public function index(){
    	return view('admin.labAnalysis.index');
    }

    public function searchClient($searchValue) {
        $user = User::where('last_name', 'like', '%'.$searchValue.'%')->orWhere('first_name', 'like', '%'.$searchValue.'%')->orWhere('middle_name', 'like', '%'.$searchValue.'%')->orWhere('business_name', 'like', '%'.$searchValue.'%')->get();
        return view('admin.labAnalysis.searchClient')->with(['user' => $user, 'searchValue' => $searchValue]);
    }

    public function getClient($selectedRecord) {
        $user = User::get()->where('slug', '=', $selectedRecord)->first();
        $labAnalysis = User\LabAnalysis::get()->where('user_slug', '=', $user->slug);
        return view('admin.labAnalysis.clientInfo')->with(['user' => $user, 'labAnalysis' => $labAnalysis]);
    }

    public function store(Request $request) {
        $lab = new User\LabAnalysis();
        $lab->slug = '00005';
        $lab->user_slug = $request->userSlug;
        $lab->report_no = $request->reportNumber;
        $lab->date_received = $request->dateReceived;
        $lab->date_analyzed = $request->dateAnalyzed;
        $lab->sample_type = $request->sampleType;
        $lab->country_of_origin = $request->countryOfOrigin;
        $lab->sample_no = $request->sampleNumber;
        $lab->product_description = $request->product;
        $lab->parameter = $request->parameter;
        $lab->sucrose = $request->sucrose;
        $lab->glucose = $request->glucose;
        $lab->lactose = $request->lactose;
        $lab->fructose = $request->fructose;
        //$lab->user_created = Auth::guard('web')->user()->slug;
        //$lab->user_updated = Auth::guard('web')->user()->slug;
        $lab->save();
    }
}
