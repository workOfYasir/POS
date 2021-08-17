<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use SoftDeletes;

    public function category(){
        return $this->belongsTo(ExpenseCategory::class,'category_id','id');
    }

    public function warehouse(){
        return $this->belongsTo(WareHouse::class,'warehouse_id','id');
    }
}
