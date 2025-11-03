<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeEducation extends Model
{
    protected $fillable = ['employee_id',	'last_education',	'institution',	'passing_year',	'result',	'remarks'];

    public function employees() {
        return $this->belongsTo(Employee::class,'employee_id');
    }
}

