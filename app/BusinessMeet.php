<?php

namespace App;

use App\Participation;
use App\Employee;

use Illuminate\Database\Eloquent\Model;

class BusinessMeet extends Model
{
    public $timestamps = false;
    protected $guarded = array('id');

    //public $timestamps = false;
    protected $fillable = ['employee_id',	'employee_participation', 'spouse_participation',	'employee_nid',	'spouse_nid'];


    public function employees() {
        return $this->belongsTo(Employee::class,'employee_id');
    }
    public function participations() {
        return $this->hasMany(Participation::class);
    }
 	public function user() {
        return $this->hasOne(User::class);
    }

}



