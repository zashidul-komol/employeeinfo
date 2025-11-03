<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobExperiance extends Model
{
    protected $fillable = ['employee_id',	'name_company',	'position',	'start_date',	'end_date',	'duration'];

    public function employees() {
        return $this->belongsTo(Employee::class,'employee_id');
    }					
}

