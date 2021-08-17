<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockProduct extends Model
{
    use SoftDeletes;

    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
