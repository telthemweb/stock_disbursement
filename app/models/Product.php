<?php

namespace Ti\Mss\App\models;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   
    protected $fillable =[
        'category_id',
        'product_code',
        'name',
        'desc',
        'imageurl',
        'barcode',
        'quantity',
        'bestbefore',
        'datestockin',
        'administrator_id',
        'stock_alert_quantity',
        'stockonhand',
        'status',
        'supplier_id'
    ];


    public  function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }

     public  function supplier()
    {
        return $this->belongsTo(supplier::class,'supplier_id','id');
    }

    public  function goodreceived()
    {
        return $this->hasMany(Goodreceived::class,'product_id','id');
    }
     public  function cidpGoodreceiveds()
    {
        return $this->hasMany(CIDPGoodreceived::class,'product_id','id');
    }

     public function disbursements()
    {
        return $this->hasMany(Disbursement::class,'product_id','id');
    }
}