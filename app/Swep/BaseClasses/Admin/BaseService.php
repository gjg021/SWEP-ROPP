<?php
 
namespace App\Swep\BaseClasses\Admin;


use App;
use Auth;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Core\Helpers\__static;
use App\Core\Helpers\__dynamic;
use App\Core\Helpers\__dataType;
use Illuminate\Events\Dispatcher;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Filesystem\FilesystemManager as Storage;


class BaseService{



    protected $auth;
    protected $session;
    protected $carbon;
    protected $str;
    protected $__static;
    protected $__dataType;
    protected $event;
    protected $mail;
    protected $storage;



    public function __construct(){
        
        $this->auth = auth();
        $this->session = session();
        $this->carbon = App::make(Carbon::class);
        $this->str = App::make(Str::class);
        $this->__static = App::make(__static::class);
        $this->__dynamic = App::make(__dynamic::class);
        $this->__dataType = App::make(__dataType::class);
        $this->event = App::make(Dispatcher::class);
        $this->mail = App::make(Mailer::class);
        $this->storage = App::make(Storage::class);
        
    }




}