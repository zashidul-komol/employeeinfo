<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model {

	//public $timestamps = false;
	protected $guarded = array('id');

	public function brand() {
		return $this->belongsTo(Brand::class);
	}
	public function size() {
		return $this->belongsTo(Size::class);
	}
	public function depot() {
		return $this->belongsTo(Depot::class);
	}

	public function shop() {
		return $this->belongsTo(Shop::class);
	}

	public function scopeIsSupporDf($query) {
		return $query->where('freeze_status', 'support')
			->whereNull('item_status');
	}
	public function scopeDepotSupportDf($query, $depotId) {
		return $query->where('depot_id', $depotId)
			->isSupporDf();
	}
	public function scopeItemCond($query, $conArr = []) {
		return $query->where(key($conArr), reset($conArr));
	}

	//item update
	public function scopeItemUpdate($query, $data, $condArr) {
		return $query->itemCond($condArr)
			->update($data);
	}

	public function scopeGetItemById($query, $id) {
		return $query->with([
			'brand' => function ($q) {
				return $q->select('id', 'short_code');
			},
			'size' => function ($q) {
				return $q->select('id', 'name');
			},
		])
			->itemCond($id)
			->select('id', 'serial_no', 'brand_id', 'size_id')
			->first();
	}

	public function problem() {
		return $this->hasOne(DfProblem::class, 'df_code', 'serial_no');
	}

	public function settlement() {
		return $this->hasOne(Settlement::class);
	}

	public function scopeDepotAvailableDf($query, $depotId) {
		return $query->whereIn('freeze_status', ['used', 'fresh'])
			->whereNull('item_status')
			->where('depot_id', $depotId)
			->count();
	}

}
