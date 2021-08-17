<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Model\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    //unit list
    public function index(Request $request)
    {
        $units = null;
        if($request->get('search')){
            $units = Unit::where('name','like','%'.$request->get('search').'%')->paginate(10);
        }else{
            $units = Unit::paginate(10);
        }
        return view('product.unit.index')->with('units',$units);
    }

    //unit create page
    public function create()
    {
        return view('product.unit.create');
    }

    //store the unit
    public function store(Request $request)
    {
        $request->validate([
           'code'=>'required',
           'name'=>'required'
        ]);
        $unit =new Unit();
        $unit->code = $request->code;
        $unit->name =$request->name;
        if($unit->save()){
            return redirect()->back()->with('success',translate('Unit Created Successfully'));
        }else{
            return redirect()->back()->with('error',translate('There are Some Problem. Please try again'));
        }
    }

    //edit the unit
    public function edit($id)
    {
        try{
            $unit = Unit::find($id);
            return view('product.unit.edit')->with('unit',$unit);
        }catch (\Exception $exception){
            return redirect()->back()->with('error',translate('There are Some Problem. Please try again'));
        }
    }
//update the unit
    public function update(Request $request)
    {
        $request->validate([
            'code'=>'required',
            'name'=>'required'
        ]);
        try{
          $unit = Unit::where('id',$request->id)->update([
             'code'=>$request->code,
             'name'=>$request->name,
          ]);
            if ($unit) {
                return redirect()->back()->with('success', translate('Unit Update Successfully'));
            } else {
                return redirect()->back()->with('failed', translate('There are Some Problem Try again'));
            }
        }catch (\Exception $exception){
            return redirect()->back()->with('error',translate('There are Some Problem. Please try again'));
        }
    }

    //soft delete the unit
    public function destroy($id)
    {
        try{
            if (Unit::where('id',$id)->delete()) {
                return redirect()->back()->with('success', translate('Unit Delete Successfully'));
            } else {
                return redirect()->back()->with('failed', translate('There are Some Problem Try again'));
            }
        }catch (\Exception $exception){
            return redirect()->back()->with('error',translate('There are Some Problem. Please try again'));
        }
    }
}
