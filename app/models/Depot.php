<?php

namespace Ti\Mss\App\models;
use Illuminate\Database\Eloquent\Model;

class Depot extends Model
{
     
    protected $fillable =[
        'name',
        'province',
        'district',
        'administrator_id'

    ];


    public  function customers()
    {
        return $this->hasMany(Customer::class,'depot_id','id');
    }

     public  function goodreceived()
    {
        return $this->hasMany(Goodreceived::class,'depot_id','id');
    }

    public  function cidpGoodreceiveds()
    {
        return $this->hasMany(CIDPGoodreceived::class,'depot_id','id');
    }

    public function administrator()
    {
        return $this->belongsTo(Administrator::class,'administrator_id','id');
    }

    public  function commondisbusements()
    {
        return $this->hasMany(CommonDisbusement::class,'depot_id','id');
    }
    
}