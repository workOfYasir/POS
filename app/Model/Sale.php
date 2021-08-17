<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use SoftDeletes;

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
