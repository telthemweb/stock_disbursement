<?php

namespace Ti\Mss\App\models;
use Illuminate\Database\Eloquent\Model;

class Disbursement extends Model
{
	 protected $table ="inputs_disbusement";
	
	protected $fillable=[
		'farmer_id',
		'cidp_id',
		'product_id',
		'quantity',
	];


    public  function CommonDisbusement()
    {
        return $this->belongsTo(CommonDisbusement::class,'cidp_id','id');
    }

    public  function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }

    public  function farmer()
    {
        return $this->belongsTo(farmer::class,'farmer_id','id');
    }

    public  function disburse()
    {
        return $this->belongsTo(Administrator::class,'administrator_id','id');
    }
}

