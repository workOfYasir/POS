<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductStock extends Model
{
    use SoftDeletes;

    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }

    public function warehouse(){
        return $this->belongsTo(WareHouse::class,'warehouse_id','id');
    }


}
