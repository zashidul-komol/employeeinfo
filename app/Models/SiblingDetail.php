<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiblingDetail extends Model
{
   protected $fillable = ['employee_id',	'sibling_name',	'occupation',	'age',	'gender'];

   public function employees() {
        return $this->belongsTo(Employee::class,'employee_id');
    }
}


