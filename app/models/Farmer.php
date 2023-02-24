<?php

namespace Ti\Mss\App\models;
use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    
    protected $fillable = [
        'cidp_id',
        'customercode',
        'name',
        'surname',
        'city',
        'address',
        'gender',
        'phonenumber',
        'email',
        'country',
        'identitynumber',
        'nextofkin',
        'province',
        'ward',
        'village',
        'marital_status'
    ];

    public  function cidp()
    {
        return $this->belongsTo(CommonDisbusement::class,'cidp_id','id');
    }

    public function disbursements()
    {
        return $this->hasMany(Disbursement::class,'farmer_id','id');
    }

    

   
}