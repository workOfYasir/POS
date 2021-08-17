<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quotation extends Model
{
   use SoftDeletes;

   public function user(){
     return $this->belongsTo(User::class,'create_by','id');
   }

   public function quotationProducts(){
       return $this->hasMany(QuotationProducts::class,'quotation_id','id');
   }
}
