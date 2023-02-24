<?php

namespace Ti\Mss\App\models;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    use HasRoles;
    protected $fillable = [
        'role_id',
        'name',
        'surname',
        'username',
        'password',
        'email',
        'phone',
        'gender',
        'country',
        'province',
        'city',
        'address',
    ];

    public  function role()
    {
        return $this->belongsTo(Role::class,'role_id','id');
    }

    public function audits()
    {
        return $this->hasMany(Audit::class,'administrator_id','id');
    }

    public  function goodreceived()
    {
        return $this->hasMany(Goodreceived::class,'distributedby','id');
    }

     public  function depot()
    {
        return $this->hasMany(Depot::class,'administrator_id','id');
    }

     public  function commondisbusement()
    {
        return $this->hasMany(CommonDisbusement::class,'administrator_id','id');
    }

    public function disbursements()
    {
        return $this->hasMany(Disbursement::class,'administrator_id','id');
    }

    protected $hidden = [
        'password', 'remember_token',
    ];
}