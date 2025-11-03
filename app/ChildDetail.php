<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChildDetail extends Model
{
    //use HasFactory;
    protected $fillable = ['employee_id',	'child_name', 'occupation',	'gender',	'date_of_birth',	'institution', 'class_name', 'education', 'child_photo'];

    public function setFilenamesAttribute($value)
    {
        $this->attributes['child_photo'] = json_encode($value);
    }

    public function employees() {
        return $this->belongsTo(Employee::class,'employee_id');
    }
}


