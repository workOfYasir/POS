<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
  use SoftDeletes;

   public function childrenCategories(){
       return $this->hasMany(Category::class)->with('childrenCategories');
   }

   public function parent(){
       return $this->hasOne(Category::class,'id','parent_category_id');
   }
}
