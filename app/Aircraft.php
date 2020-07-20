<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aircraft extends Model
{
    //
    public $table = "aircrafts";

    protected $fillable = [
    	'name',
    	'hub_id'	
    ];
    
}
