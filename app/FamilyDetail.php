<?php

namespace App;
use App\Employee;
use Illuminate\Database\Eloquent\Model;

class FamilyDetail extends Model
{
    protected $fillable = ['employee_id', 'father_name', 'father_occupation', 'father_live_status', 'mother_name', 'mother_occupation', 'mother_live_status', 'wife_name', 'wife_occupation', 'marriage_date', 'no_of_brothers', 'no_of_sisters'];

    public function employees() {
        return $this->belongsTo(Employee::class,'employee_id');
    }

}

