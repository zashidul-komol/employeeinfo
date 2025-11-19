<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settlement extends Model {
	public $timestamps = false;
	protected $dates = ['inject_date', 'closed_date', 'month_from', 'month_to'];
	protected $guarded = array('id');
}
