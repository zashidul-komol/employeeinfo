<?php

namespace App;
use App\Organization;

use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    //use HasFactory;
    protected $fillable = ['employee_id',	'name', 'organization_id',	'gender',	'relationship'];

    public function employees() {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    public function organizations() {
        return $this->belongsTo(Organization::class, 'organization_id');
    }
 
}


