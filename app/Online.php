<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Online extends Model
{

    protected $fillable = ['ip'];

    public static function getIp()
    {
        $client = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote = @$_SERVER['REMOTE_ADDR'];

        if(filter_var($client, FILTER_VALIDATE_IP)) $ip = $client;
        if(filter_var($forward, FILTER_VALIDATE_IP)) $ip = $forward;
        else $ip = $remote;

        return $ip;
    }

    public static function countUnregisrteredVisitors(){

        $ip = self::getIp();

        $foundedIp = self::where('ip', $ip)->first();

        if(@$foundedIp) $foundedIp->delete();


        //if user is not authenticated add ip to DB
       if(!Auth::check()) self::create(['ip' => $ip]);

        $nowMinusMinute = date('Y-m-d H:i:s', time()-60);

        //delete very old visitors
         self::where('created_at','<', $nowMinusMinute)->delete();

        $number = self::count();

        return $number;
    }
}
