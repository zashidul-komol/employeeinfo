<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplainType extends Model {
	public $timestamps = false;
	public function problem_type() {
		return $this->belongsTo(ProblemType::class);
	}
	public function problem() {
		return $this->belongsTo(DfProblem::class);
	}
}
