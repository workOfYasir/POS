<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserHasGroup extends Model
{
    protected $table = 'user_has_groups';
    public $timestamps = false;

    public function groups(){
        return $this->hasMany(Group::class,'id','group_id');
    }
}
