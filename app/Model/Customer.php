<?php

namespace App\Model;

use App\model\CustomerType;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Customer extends Model
{
    use SoftDeletes,Notifiable;

    public function user(){
        return $this->belongsTo(User::class,'create_by','id');
    }
    public function CustomerType(){
        return $this->belongsTo(CustomerType::class,'type','id');
    }
}
