<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\User\PreRegistrationModel;
use App\Swep\Repositories\Admin\PreRegistrationRepository;
use Carbon\Carbon;
use DataTables;
use Illuminate\Http\Request;

class PreRegistrationController extends Controller
{
    protected $preRegistrationRepo;
    public function __construct(PreRegistrationRepository $preRegistrationRepo)
    {
        $this->preRegistrationRepo = $preRegistrationRepo;
    }

    public function index(){
        if(request()->ajax())
        {
            $data = request();
            return DataTables::of($this->preRegistrationRepo->fetchTable($data))
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
                })
                ->escapeColumns([])
                ->setRowId('slug')
//                ->make(true)
                ->toJson();
        }
        return view('admin.preRegistration.index');
    }

    private function hyphenate($str) {
        return implode("-", str_split($str, 3));
    }

    public function storePreRegistration(Request $request)
    {
        $preReg = new PreRegistrationModel();
        $preReg->slug = strtoupper($this->hyphenate(str_shuffle(str_random(5) . rand(1000, 9999)))) . '-' . date('my');
        $preReg->last_name = $request->lastName;
        $preReg->first_name = $request->firstName;
        $preReg->middle_name = $request->middleName;
        $preReg->phone = $request->phoneNumber;
        $preReg->email = $request->email;
        $preReg->birthday = $request->birthday;
        $preReg->street = $request->birthday;
        $preReg->barangay = $request->barangay;
        $preReg->city = $request->city;
        $preReg->business_name = $request->businessName;
        $preReg->business_tin = $request->businessTin;
        $preReg->business_phone = $request->businessPhone;
        $preReg->position = $request->position;
        $preReg->business_street = $request->business_street;
        $preReg->business_barangay = $request->business_barangay;
        $preReg->business_city = $request->business_city;
        $preReg->is_verified = false;
        $preReg->created_at = Carbon::now();
        $preReg->updated_at = Carbon::now();
        $preReg->save();
    }
}