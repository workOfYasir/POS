<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{

    protected $table = 'groups';
    use SoftDeletes;

    public function permissions(){
        return $this->hasMany(GroupHasPermission::class,'group_id','id');
    }

}
