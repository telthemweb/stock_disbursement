<?php

namespace Ti\Mss\App\models;
use Illuminate\Database\Eloquent\Model;
class Systemlogs extends Model
{
    protected $fillable =[
        'administrator_id',
        'timein',
        'ipaddress',
        'geolocationap',
        'useaccountname',
        'timeout',
    ];


    public  function admin()
    {
        return $this->belongsTo(Administrator::class,'administrator_id','id');
    }
}