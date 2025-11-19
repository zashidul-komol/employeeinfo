<?php

namespace App\Models;

use App\Models\BusinessMeet;
use App\Models\Employee;

use Illuminate\Database\Eloquent\Model;

class Participation extends Model
{
    public $timestamps = false;
    protected $guarded = array('id');

    //public $timestamps = false;
    protected $fillable = ['bm_id', 'employee_id',   'child_name', 'child_age',   'child_gender', 'child_participation', 'reason'];


    public function employees() {
        return $this->belongsTo(Employee::class,'employee_id');
    }
    public function businessmeets() {
        return $this->belongsTo(BusinessMeet::class);
    }

    public function user() {
        return $this->hasOne(User::class);
    }

}



