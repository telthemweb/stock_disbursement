<?php

namespace Ti\Mss\App\models;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model{

     protected $table ="suppliers";
	protected $fillable =[
        "name", "address", "administrator_id", "email", "phone", "city","image", "status"
    ];


    public  function products()
    {
        return $this->hasMany(Product::class,'supplier_id','id');
    }


}