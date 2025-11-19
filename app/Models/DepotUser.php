<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DepotUser extends Model {
    public $timestamps = false;
    protected $guarded = array('id');

    public function depot() {
        return $this->belongsTo(Depot::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
