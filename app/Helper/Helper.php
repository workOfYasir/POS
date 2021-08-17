<?php


namespace App\Helper;


use App\Model\Organization;
use File;
use Illuminate\Support\Facades\DB;

class Helper
{

  public static function organization(){
      return Organization::find(1);
  }
}
