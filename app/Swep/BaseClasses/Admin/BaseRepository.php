<?php
 
namespace App\Swep\BaseClasses\Admin;


use App;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Core\Helpers\__dataType;
use Illuminate\Cache\Repository as Cache;


class BaseRepository{



    protected $auth;
    protected $carbon;
    protected $str;
    protected $__dataType;
    protected $cache;



    public function __construct(){
        
        $this->auth = auth();
        $this->carbon = App::make(Carbon::class);
        $this->str = App::make(Str::class);
        $this->__dataType = App::make(__dataType::class);
        $this->cache = App::make(Cache::class);
        
    }




}