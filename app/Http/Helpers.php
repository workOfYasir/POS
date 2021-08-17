<?php

use App\Helper\Helper;

/**
 * Open Translation File
 * @return Response
 */
function openJSONFile($code){
    $jsonString = [];
    if(File::exists(base_path('resources/lang/'.$code.'.json'))){
        $jsonString = file_get_contents(base_path('resources/lang/'.$code.'.json'));
        $jsonString = json_decode($jsonString, true);
    }
    return $jsonString;
}

/**
 * Save JSON File
 * @return Response
 */
function saveJSONFile($code, $data){
    ksort($data);
    $jsonData = json_encode($data, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
    file_put_contents(base_path('resources/lang/'.$code.'.json'), stripslashes($jsonData));
}

function translate($key){
    $key = ucfirst(str_replace('_', ' ', $key));
    if(File::exists(base_path('resources/lang/en.json'))){
        $jsonString = file_get_contents(base_path('resources/lang/en.json'));
        $jsonString = json_decode($jsonString, true);
        if(!isset($jsonString[$key])){
            $jsonString[$key] = $key;
            saveJSONFile('en', $jsonString);
        }
    }
    return __($key);
}

//scan directory for load flag
function readFlag(){
    $dir = base_path('public/uploads/lang');
    $file = scandir($dir);
    return $file;
}

function flag($name){
    $nameSubStr = substr($name, 8);
    $nameReplace = ucfirst(str_replace('_', ' ', $nameSubStr));
    $nameReplace2 = ucfirst(str_replace('.png', '', $nameReplace));
    return  $nameReplace2;
}

function formatePrice($price){
    $org = Helper::organization();
    return $org->align == 0 ? $org->symbol.  number_format($price, 2)  :  number_format($price, 2)  .$org->symbol;
}


function barcode_asset($path, $secure = null)
{
    return app('url')->asset('barcode/'.$path, $secure);
}
