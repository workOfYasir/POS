<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupHasPermission extends Model
{
    protected $table = 'group_has_permissions';
    
    public $timestamps = false;

    public function group(){
        return $this->belongsTo(Group::class,'id','group_id');
    }

    public function permissions(){
        return $this->hasMany(Permission::class,'id','permission_id');
    }
}
