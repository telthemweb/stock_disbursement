<?php

namespace Ti\Mss\App\models;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    protected $fillable =[
        'administrator_id',
        'entity',
        'oldvalue',
        'newvalue',
        'action',
    ];
  

    public  function admin()
    {
        return $this->belongsTo(Administrator::class,'administrator_id','id');
    }
}