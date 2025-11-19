<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfficeLocation extends Model
{
    //protected $fillable = ['name', 'address', 'status'];
    public $timestamps = false;
    protected $guarded = array('id');
}

