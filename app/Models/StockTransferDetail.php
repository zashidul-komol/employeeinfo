<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockTransferDetail extends Model {

    public function brand() {
        return $this->belongsTo(Brand::class);
    }
    public function size() {
        return $this->belongsTo(Size::class);
    }
}
