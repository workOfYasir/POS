<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Model\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    //list supplier
    public function index(Request $request)
    {
        $suppliers = null;
        if($request->get('search')){
            $suppliers = Supplier::where('name','like','%'.$request->get('search').'%')->paginate(10);
        }else{
            $suppliers = Supplier::paginate(10);
        }
        return view('setting.supplier.index')
            ->with('suppliers',$suppliers);
    }

    //create page for supplier
    public function create()
    {
        return view('setting.supplier.create');
    }

//store the supplier
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
        ]);
        try{
           $supplier =new Supplier();
           $supplier->name = $request->name ;
           $supplier->org = $request->org ;
           $supplier->email = $request->email ;
           $supplier->phone = $request->phone ;
           $supplier->address = $request->address ;
           //store the supplier image in server
            $imageName =null;
            if($request->hasFile('image')){
                $image = $request->file('image');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('uploads/supplier'),$imageName);
            }
            $supplier->image = $imageName;
            if($supplier->save()){
                return redirect()->back()->with('success',translate('Supplier Created Successfully'));
            }else{
                return redirect()->back()->with('error',translate('There are Some Problem. Please try again'));
            }
        }catch (\Exception $exception){
            return redirect()->back()->with('error',translate('There are Some Problem. Please try again'));
        }
    }

    //update the supplier
    public function edit($id)
    {
        try {
            $supplier =Supplier::find($id);
            return view('setting.supplier.edit')->with('supplier',$supplier);
        }catch (\Exception $exception){
            return redirect()->back()->with('error',translate('There are Some Problem. Please try again'));
        }
    }

    //update the supplier
    public function update(Request $request)
    {
        $request->validate([
            'name'=>'required',
        ]);
        $imageName = null;
        try{
         //store the image
            if($request->hasFile('newImage')){
                //delete old image
                try {
                    $path = 'uploads/supplier/'.$request->image;
                    if(file_exists($path)){
                        unlink($path);
                    }
                }catch (\Exception $e){}

                $image = $request->file('newImage');
                $imageName = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('uploads/supplier'),$imageName);
            }else{
                $imageName = $request->image;
            }
            //update here the database
            $supplier = Supplier::where('id',$request->id)->update([
                'name' => $request->name,
                'org' => $request->org,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'image' => $imageName,
            ]);
            if ($supplier) {
                return redirect()->back()->with('success', translate('Supplier Update Successfully'));
            } else {
                return redirect()->back()->with('failed', translate('There are Some Problem Try again'));
            }
        }catch (\Exception $exception){
            return redirect()->back()->with('error',translate('There are Some Problem. Please try again'));
        }
    }

    //soft delete the supplier
    public function destroy($id)
    {
        try{
            if (Supplier::where('id',$id)->delete()) {
                return redirect()->back()->with('success', translate('Supplier Delete Successfully'));
            } else {
                return redirect()->back()->with('failed', translate('There are Some Problem Try again'));
            }
        }catch (\Exception $exception){
            return redirect()->back()->with('error',translate('There are Some Problem. Please try again'));
        }
    }
}
