<?php

namespace Ti\Mss\App\models;
use Illuminate\Database\Eloquent\Model;

class CustomerGroup extends Model
{
    protected $fillable =[
        'name',
        'administrator_id',
        'totalnumber'
    ];
    

    

    public  function customers()
    {
        return $this->hasMany(Customer::class,'customergroup_id','id');
    }
}