<?php

namespace App\Swep\Repositories\User;
 
use App\Swep\BaseClasses\Admin\BaseRepository;
use App\Swep\Interfaces\User\UserInterface;

use App\Models\User;
use App\Models\User\UserEmailVerification;

use Auth;
use Hash;

class UserRepository extends BaseRepository implements UserInterface {
    

    protected $user;
    protected $user_email_verification;

    public function __construct(User $user,UserEmailVerification $user_email_verification){

        $this->user = $user;
        $this->user_email_verification = $user_email_verification;
        parent::__construct();
    }




    public function fetch($slug){

       

    }

    public function fetchTable($data){
        $get = $this->user;

        return $get->latest()->get();
    }


    public function store($request){
        $user = new User;
        $user->slug = $request->slug;
        $user->first_name = $request->first_name;
        $user->middle_name = $request->middle_name;
        $user->last_name = $request->last_name;
        $user->birthday = $request->birthday;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->remember_token = $request->remember_token;
        $user->created_at = $this->carbon->now();
        $user->updated_at = $this->carbon->now();
        //$user->is_active = $request->is_active;
        //$user->is_verified = $request->is_verified;
        $user->phone = $request->phone;
        $user->business_name = $request->business_name;
        $user->business_tin = $request->business_tin;
        $user->business_phone = $request->business_phone;
        $user->region = $request->region;
        $user->province = $request->province;
        $user->municipality = $request->municipality;
        $user->barangay = $request->barangay;
        $user->address = $request->address;

        if(!$user->save()){
            abort(500,'Error saving data.');
        }
        return $user;
    }




    public function update($request, $slug){

       

    }




    public function destroy($slug){

        $user = $this->user->where('slug',$slug)->first();
        $user->delete();

    }

    public function findBySlug($slug){
        $user = $this->user
                ->where('slug','=',$slug)
                ->first();
        return $user;
    }




    public function getRaw(){
        
    }

    public function storeEmailVerification($user_slug){
        $uev = new UserEmailVerification;

        $uev->user_slug = $user_slug;
        $uev->verification_slug = $this->str->random(45);
        $uev->created_at = $this->carbon->now();

        if(!$uev->save()){
            abort(500, 'Error saving verification data.');
        }

        return $uev;
    }

    public function verifyEmail($request){
        $user_slug = $request->uid;
        $verification_slug = $request->uev;
        // return $verification_slug;
        $uev = $this->user_email_verification
                ->where('verification_slug','=',$verification_slug)
                ->where('user_slug','=',$user_slug)
                ->get();

        if($uev->count()>0){
            $user = $this->findBySlug($user_slug);
            $user->is_verified = 1;
            if($user->save()){
                return 1;
            }
            abort(404, 'User not found');
        }
        
        abort(404,'User not found');
    }

}