<?php

namespace App\model;

use App\Model\Sale;
use Illuminate\Database\Eloquent\Model;

class SaleHistory extends Model
{
    public function sale(){
        return $this->belongsTo(Sale::class,'sale_id','id');
    }
    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id','id')->with('CustomerType');
    }
    public function user(){
        return $this->belongsTo(User::class,'create_by','id');
    }

    public function saleProducts(){
        return $this->hasMany(SaleProduct::class)->with('product');
    }
}
