<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Model\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    //edit the Organization
    public function edit(){
        $org =Organization::find(1);
        return view('setting.organization.org')->with('org',$org);
    }

    //show shortcut
    public function shortcut(){
        return view('setting.organization.shortcut');
    }

    //update the organization
    public function update(Request $request){
        try{
           //store the image on server
            if($request->hasFile('newLogo')){
                //delete old image
                try {
                    $path = 'uploads/org/'.$request->logo;
                    if(file_exists($path)){
                        unlink($path);
                    }
                }catch (\Exception $e){}

                $image = $request->file('newLogo');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('uploads/org'),$imageName);
            }else{
                $imageName = $request->logo;
            }

            $org = Organization::where('id',1)->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'about'=>$request->about,
                'header'=>$request->header,
                'footer'=>$request->footer,
                'logo'=>$imageName,
                'symbol'=>' '.$request->symbol.' ',
                'align'=>$request->align,
            ]);
            if ($org) {
                return redirect()->back()->with('success',translate('Organization Setup Update Successfully'));
            } else {
                return redirect()->back()->with('failed',translate('There are Some Problem Try again'));
            }

        }catch (\Exception $exception){
            return redirect()->back()->with('error',translate('There are Some Problem. Please try again'));
        }
    }

    //mail setting page
    public  function  smtp(){
        return view('setting.organization.smtp');
    }

    /*pos setting*/
    public function posSetting(){
        return view('setting.organization.possetting');
    }

    //update the env file and save the mail setup
    public function env_key_update(Request $request)
    {
        foreach ($request->types as $key => $type) {
            $this->overWriteEnvFile($type, $request[$type]);
        }
        return back()->with('success', translate('Setting Setup  Successfully'));
    }

    //store data in env file
    public  static function   overWriteEnvFile($type, $val)
    {
        $path = base_path('.env');
        if (file_exists($path)) {
            $val = '"'.trim($val).'"';
            if(is_numeric(strpos(file_get_contents($path), $type)) && strpos(file_get_contents($path), $type) >= 0){
                file_put_contents($path, str_replace($type.'="'.env($type).'"', $type.'='.$val, file_get_contents($path)));
            }
            else{
                file_put_contents($path, file_get_contents($path)."\r\n".$type.'='.$val);
            }
        }
    }
}
