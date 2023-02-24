<?php

namespace Ti\Mss\App\models;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model{

     protected $table ="generalsettings";
	protected $fillable =[
        "site_title", "site_logo","favicon", "administrator_id", "currency", "currency_position", "developed_by", "status"
    ];


}