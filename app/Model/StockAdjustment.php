<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class StockAdjustment extends Model
{
    //

    public function adjustmentProduct(){
        return $this->hasMany(StockAdjustmentProduct::class,'stock_adjustment_id','id')->with('product');
    }
    public function user(){
        return $this->hasOne(User::class,'confirm_by','id');
    }

    public function warehouse(){
        return $this->hasOne(WareHouse::class,'id','warehouse_id');
    }
}
