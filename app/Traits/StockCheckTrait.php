<?php

namespace App\Traits;
use App\Models\Shop;
use App\Models\Item;
trait StockCheckTrait {

    public function checkAvailableStock($size_id,$shop_id=null,$depotId = null){
       
        if($shop_id){
            $depotId = Shop::where('id',$shop_id)->value('depot_id');
        }
        $totalItem = Item::whereIn('freeze_status', ['fresh', 'used', 'low_cooling'])
        ->where('depot_id', $depotId)
        ->where('size_id', $size_id)
        ->whereNull('item_status')
        ->count();
        return $totalItem;
    }
     

}
