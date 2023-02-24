<?php

namespace Ti\Mss\App\models;
use Illuminate\Database\Eloquent\Model;

class CIDPGoodreceived extends Model
{
	 protected $table ="cidp_product_stocks";
	
	protected $fillable=[
		'docnumber',
		'quantity',
		'product_id',
		'depot_id',
		'cidp_id',
		'stock_alert_quantity',
		'distributedby',
		'status'
	];

	public  function depot()
    {
        return $this->belongsTo(Depot::class,'depot_id','id');
    }
    public  function CommonDisbusement()
    {
        return $this->belongsTo(CommonDisbusement::class,'cidp_id','id');
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

