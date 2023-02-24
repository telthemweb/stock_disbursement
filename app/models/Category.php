<?php

namespace Ti\Mss\App\models;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable =[
        'name'
    ];


    public  function products()
    {
        return $this->hasMany(Product::class,'category_id','id');
    }
}