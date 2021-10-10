<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\User\OrderOfPayments;
use App\Models\User\SupportingDocuments;
use App\Swep\Repositories\Admin\OrderOfPaymentRepository;
use Carbon\Carbon;
use DataTables;
use File;
class OrderOfPaymentsController extends Controller
{
    protected $op_repo;
    public function __construct(OrderOfPaymentRepository $op_repo)
    {
        $this->op_repo = $op_repo;
    }

    public function index(){
        if(request()->ajax())
        {
            $data = request();
            return DataTables::eloquent($this->op_repo->fetchTable($data))
                ->addColumn('action', function($data){
                    $button = '<div class="btn-group">
                                <button type="button" class="btn btn-primary btn-sm view_btn" data="'.$data->slug.'" data-toggle="modal" title="VIEW" data-target="#view_modal">
                                    <i class="fa fa-search-plus"></i>
                                 </button>
                            </div>';
                    return $button;
                })
                ->addColumn('status',function ($data){
                    if($data->expires_on <= Carbon::now()){
                        return '<div class="label bg-red">Expired | '.$data->status.'</div>';
                    }else{
                        return '<div class="label bg-green">'.$data->status.'</div>';
                    }
                })
                ->editColumn('slug',' <p style="font-family:Consolas,monospace; font-size:115%">{{$slug}}</p>')
                ->editColumn('created_at', function ($data){
                    return date('M. d, Y | h:i:A',strtotime($data->created_at));
                })
                ->editColumn('business_name',function($data){
                    return $data->user->business_name;
                })
                ->editColumn('total_amount', function ($data){
                    return number_format($data->total_amount,2);
                })
                ->escapeColumns([])
                ->setRowId('slug')
//                ->make(true)
                ->toJson();
        }
        return view('admin.payments.index');
    }

    public function show($id){
            $op = OrderOfPayments::where('slug',$id)->first();
            $user = User::where('slug',$op->user_created)->first();
            $opDetails = User\OrderOfPaymentsDetailsModel::where('order_of_payments_slug', $op->slug)->get();

            return view('admin.payments.show')->with(['op' => $op, 'user' => $user, 'opDetails' => $opDetails]);
    }

    public function edit($id){
        $opUp = $this->op_repo->update($id);
        return view('admin.payments.update')->with(['op' => $opUp]);
    }

    public function view_file(){
        if(!empty(request()->file)){
            $file = SupportingDocuments::with('orderOfPayment')->find(request()->file);
            if($file->count() > 0){
                $owner_of_file = $file->orderOfPayment->user_created;
                if('936501743' != $owner_of_file){
                    abort(404);
                }
                $path = "C:/swep_rd_storage/uploaded_documents/".$file->path;
                if(!File::exists($path)){
                    abort(500);
                }

                $file = File::get($path);
                $type = File::mimeType($path);
                $response = response()->make($file, 200);
                $response->header("Content-Type", $type);
                $response->header('Content-Disposition', 'filename="downloaded.pdf"');
                return $response;
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }
    }
}