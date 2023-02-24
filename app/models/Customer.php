<?php

namespace Ti\Mss\App\models;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table ="farmers";
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

    

   
}