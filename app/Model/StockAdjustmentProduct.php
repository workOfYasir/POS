<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StockAdjustmentProduct extends Model
{
    //
    public function product(){
        return $this->hasOne(Product::class,'id','product_id');
    }
}
