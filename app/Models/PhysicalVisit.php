<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhysicalVisit extends Model{
    public $timestamps = false;
    protected $guarded = array('id');
    
    public function requisition() {
        return $this->belongsTo(Requisition::class);
    }
    public function user() {
        return $this->belongsTo(User::class);
    }
}
