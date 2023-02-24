<?php

namespace Ti\Mss\App\models;
use Illuminate\Database\Eloquent\Model;

class Goodreceived extends Model
{
	 protected $table ="product_stocks";
	
	protected $fillable=[
		'docnumber',
		'quantity',
		'product_id',
		'depot_id',
		'stock_alert_quantity',
		'distributedby',
		'status'
	];

	public  function depot()
    {
        return $this->belongsTo(Depot::class,'depot_id','id');
    }

    public  function product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }

    public  function administrator()
    {
        return $this->belongsTo(administrator::class,'distributedby','id');
    }
}

