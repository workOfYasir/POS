<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    use SoftDeletes;

    public function supplier(){
        return $this->belongsTo(Supplier::class,'supplier_id','id');
    }

    public function warehouse(){
        return $this->belongsTo(WareHouse::class,'warehouse_id','id');
    }


    public function user(){
      return $this->belongsTo(User::class,'create_by','id');
    }

    public function payments(){
        return $this->hasMany(PurchasePayment::class,'purchase_id','id');
    }

    public function purchaseProducts(){
        return $this->hasMany(PurchaseProduct::class,'purchase_id','id');
    }
}
