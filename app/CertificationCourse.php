<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CertificationCourse extends Model
{
   protected $fillable = ['employee_id',	'name_course',	'institution',	'passing_year',	'result',	'remarks'];

   public function employees() {
        return $this->belongsTo(Employee::class,'employee_id');
    }
}


