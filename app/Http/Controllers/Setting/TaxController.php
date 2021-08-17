<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Model\Tax;
use Illuminate\Http\Request;
use Mockery\Exception;

class TaxController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    //tax list
    public function index()
    {
        $taxes = Tax::all();
        return view('setting.tax.index')->with('taxes',$taxes);
    }

    //tax create page
    public function create()
    {
        return view('setting.tax.create');
    }

    //store the tax data
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'rate'=>'required'
        ]);
        $tax =new Tax();
        $tax->name = $request->name;
        $tax->rate = $request->rate;
        if($tax->save()){
            return redirect()->back()->with('success',translate('Tax Created Successfully'));
        }else{
            return redirect()->back()->with('error',translate('There are Some Problem. Please try again'));
        }
    }

    //edit the tax
    public function edit($id)
    {
        try{
            $tax = Tax::find($id);
            return view('setting.tax.edit')->with('tax',$tax);
        }catch (Exception $exception){
            return redirect()->back()->with('error',translate('There are Some Problem. Please try again'));
        }
    }

    //update the tax
    public function update(Request $request)
    {
        $request->validate([
            'rate'=>'required',
            'name'=>'required'
        ]);
        try{
            $tax = Tax::where('id',$request->id)->update([
                'rate'=>$request->rate,
                'name'=>$request->name,
            ]);
            if ($tax) {
                return redirect()->back()->with('success', translate('Tax Update Successfully'));
            } else {
                return redirect()->back()->with('failed', translate('There are Some Problem Try again'));
            }
        }catch (\Exception $exception){
            return redirect()->back()->with('error',translate('There are Some Problem. Please try again'));
        }
    }

    //soft delete the tax
    public function destroy($id)
    {
        try{
            if (Tax::where('id',$id)->delete()) {
                return redirect()->back()->with('success', translate('Tax Delete Successfully'));
            } else {
                return redirect()->back()->with('failed', translate('There are Some Problem Try again'));
            }
        }catch (\Exception $exception){
            return redirect()->back()->with('error',translate('There are Some Problem. Please try again'));
        }
    }
}
