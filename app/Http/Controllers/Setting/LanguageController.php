<?php

namespace App\Http\Controllers\Setting;

use App\Helper\Helper;
use App\Http\Controllers\Controller;
use App\Model\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    //list of language
    public function index()
    {
        $languages = Language::all();
        return view('setting.organization.lan')->with('languages',$languages);
    }

    //store a  new language
    public function store(Request $request)
    {
        $request->validate([
            'code'=>['required','unique:languages'],
            'name'=>['required','unique:languages'],
            'image'=>['required','unique:languages']
        ]);
        $lan = new Language();
        $lan->code = $request->code;
        $lan->name =$request->name;
        $lan->image = $request->image;
        if($lan->save()){
            return redirect()->back()->with('success',translate('Language Created Successfully'));
        }else{
            return redirect()->back()->with('error',translate('There are Some Problem. Please try again'));
        }
    }

//delete the language
    public function destroy($id)
    {
        try{
            if (Language::where('id',$id)->forceDelete()) {
                return redirect()->back()->with('success',translate('Language Delete Successfully'));
            } else {
                return redirect()->back()->with('failed',translate('There are Some Problem Try again'));
            }
        }catch (\Exception $exception){
            return redirect()->back()->with('error',translate('There are Some Problem. Please try again'));
        }
    }

    //languages for create translate
    public function translate_create($id){
        try{
            $lang = Language::find($id);
            if ($lang) {
                return view('setting.organization.translate')->with('lang',$lang);
            } else {
                return redirect()->back()->with('failed',translate('There are Some Problem Try again'));
            }
        }catch (\Exception $exception){
            return redirect()->back()->with('error',translate('There are Some Problem. Please try again'));
        }
    }


    //translate language save ase a json format file
    public function translate_store(Request $request){
        $language = Language::findOrFail($request->id);
        //check the key have translate data
        $data = openJSONFile($language->code);
        foreach ($request->translations as $key => $value) {
            $data[$key] = $value;
        }
        //save the new keys translate data
        saveJSONFile($language->code, $data);
        return back()->with('success', translate('Translation has been saved.'));
    }

    //change the language
    public function changeLanguage(Request $request)
    {
        $request->session()->put('locale', $request->code);
        Artisan::call('view:clear');
        return redirect()->back();
    }

    //defaultLanguage
    public function defaultLanguage($id){
        $language = Language::findOrFail($id);
        OrganizationController::overWriteEnvFile('DEFAULT_LANGUAGE', $language->code);
        \session()->put('locale', $language->code);
        Artisan::call('view:clear');
        return redirect()->back()->with('success',translate('Language  Is  Default or changed '));
    }
}
