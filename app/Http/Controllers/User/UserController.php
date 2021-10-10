<?php

namespace App\Http\Controllers\User;

use App\Models\User\PreRegistrationModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserFormRequest;
use App\Swep\Services\User\UserService;
use Mail;
class UserController extends Controller
{   
    protected $user_service;
    
    public function __construct(UserService $user_service){
        $this->user_service = $user_service;

        parent::__construct();
    }

    public function index()
    {
        return view('admin.user.index');
    }

    public function create()
    {
        
    }

    public function store(UserFormRequest $request)
    {
        //return $request;
        $user = $this->user_service->store($request); 
        return $user;
    }

   
    public function showForm()
    {
        return view('auth.signup');
    }

    public function edit($id)
    {
        
    }

    
    public function update(Request $request, $id)
    {
        
    }

   
    public function destroy($id)
    {
        //
    }

    public function verifyEmail(){
        $request = request();
        $user_verification = $this->user_service->verifyEmail($request);

        if($user_verification == 1){
            $this->session->flush();
            $this->session->flash('VERIFIED_EMAIL', 'Your email has been verified. You may now login to your account');
            return redirect('/');
        }
        abort(404, 'Page not found');
    }

    
}
