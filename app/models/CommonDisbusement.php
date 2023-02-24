<?php

namespace Ti\Mss\App\models;
use Illuminate\Database\Eloquent\Model;

class CommonDisbusement extends Model
{
	protected $table ="common_disbuses";
	protected $fillable =[
        'name',
        'depot_id',
        'administrator_id'
    ];

     public  function depot()
    {
        return $this->belongsTo(Depot::class,'depot_id','id');
    }

    public  function administrator()
    {
        return $this->belongsTo(Administrator::class,'administrator_id','id');
    }

    public function farmers()
    {
        return $this->hasMany(Farmer::class,'cidp_id','id');
    }

    public function cidpGoodreceiveds()
    {
        return $this->hasMany(CIDPGoodreceived::class,'cidp_id','id');
    }



    public function disbursements()
    {
        return $this->hasMany(Disbursement::class,'cidp_id','id');
    }
}