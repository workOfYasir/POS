<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use SoftDeletes;

    public function toWarehouse(){
        return $this->belongsTo(WareHouse::class,'to_warehouse','id');
    }

    public function fromWarehouse(){
        return $this->belongsTo(WareHouse::class,'from_warehouse','id');
    }

    public function stockProducts(){
        return $this->hasMany(StockProduct::class,'stock_id','id');
    }

    public static function productName($id){
        return Product::find($id)->name;
    }
}
