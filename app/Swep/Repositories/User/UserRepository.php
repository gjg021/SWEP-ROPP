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
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->last_name = $request->lastName;
        $user->first_name = $request->firstName;
        $user->middle_name = $request->middleName;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->birthday = $request->birthday;
        $user->street = $request->street;
        $user->barangay = $request->barangay;
        $user->city = $request->city;
        $user->region = $request->region;
        $user->province = $request->province;
        $user->business_name = $request->busineseName;
        $user->business_tin = $request->businessTin;
        $user->business_phone = $request->businessPhone;
        $user->position = $request->position;
        $user->business_street = $request->businessStreet;
        $user->business_barangay = $request->businessbarangay;
        $user->business_city = $request->businessCity;
        $user->remember_token = $request->remember_token;
        $user->created_at = $this->carbon->now();
        $user->updated_at = $this->carbon->now();
        //$user->is_active = $request->is_active;
        //$user->is_verified = $request->is_verified;

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