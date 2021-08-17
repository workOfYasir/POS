<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ReturnProduct extends Model
{
    //
    public function product(){
        return $this->hasOne(Product::class,'id','product_id');
    }

    public function sale(){
        return $this->hasOne(Sale::class,'id','sale_id')->with('customer');
    }

    public function user(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
