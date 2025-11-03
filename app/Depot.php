<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Depot extends Model {
    public $timestamps = false;
    protected $guarded = array('id');

    public function division() {
        return $this->belongsTo(Location::class);
    }

    public function district() {
        return $this->belongsTo(Location::class);
    }

    public function thana() {
        return $this->belongsTo(Location::class);
    }

    public function region() {
        return $this->belongsTo(Zone::class);
    }
    public function area() {
        return $this->belongsTo(Zone::class);
    }
    public function designation() {
        return $this->belongsTo(Designation::class);
    }
    public function distributors() {
        return $this->hasMany(Shop::class)->where('is_distributor', true);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function availableQty() {
        return $this->hasMany(Item::class)->whereIn('freeze_status', ['used', 'fresh'])->whereNull('item_status');
    }

}
