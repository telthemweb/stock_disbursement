<?php

namespace Ti\Mss\App\models;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable =[
        'name',
        'level'
    ];

    public function administrators()
    {
        return $this->hasMany(Administrator::class,'role_id','id');
    }
}