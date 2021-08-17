<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function brand(){
        return $this->belongsTo(Brand::class,'brand_id','id');
    }

    public function unit(){
        return $this->belongsTo(Unit::class,'unit_id','id');
    }

    public  function tax(){
        return $this->belongsTo(Tax::class,'tax_id','id');
    }

    public function productStock(){
        return $this->hasOne(ProductStock::class,'product_id','id')->where('quantity', '!=' ,'0');
    }

    public function totalProductStock(){
        return $this->hasMany(ProductStock::class,'product_id','id');
    }

}
