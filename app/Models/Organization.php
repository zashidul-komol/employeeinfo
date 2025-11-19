<?php

namespace App\Models;
use App\Models\Relationship;


use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    public $timestamps = false;
	protected $guarded = array('id');
	
	public function relationships() {
        return $this->belongsTo(Relationship::class, 'organization_id');
    }
}
