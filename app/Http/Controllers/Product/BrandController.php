<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Model\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    //show the brand
    public function index(Request $request)
    {
        $brands = null;
        if($request->get('search')){
            $search =$request->search;
            $brands = Brand::where('name','like','%'.$search.'%')->paginate(10);
        }else{
            $brands = Brand::paginate(10);
        }
        return view('product.brand.index')->with('brands',$brands);
    }

    //brand create page
    public function create()
    {
        return view('product.brand.create');
    }

    //create the brand with image
    public function store(Request $request)
    {
        $request->validate([
           'name'=>'required',
           'image'=>'required'
        ]);
        try{
            $brand = new Brand();
            $brand->name = $request->name;
            $brand->slug = Str::slug($request->name);
            //upload the image
            if($request->hasFile('image')){
                $image = $request->file('image');
                $imageName = $brand->slug.'.'.$image->getClientOriginalExtension();
                $image->move(public_path('uploads/brand'),$imageName);
            }
            $brand->image = $imageName;
            if($brand->save()){
                return redirect()->back()->with('success',translate('Brand Created Successfully'));
            }else{
                return redirect()->back()->with('error',translate('There are Some Problem. Please try again'));
            }
        }catch (\Exception $exception){
            return redirect()->back()->with('error',translate('There are Some Problem. Please try again'));
        }
    }

//edit page
    public function edit($id)
    {
        try {
            $brand =Brand::find($id);
            return view('product.brand.edit')->with('brand',$brand);

        }catch (\Exception $exception){
            return redirect()->back()->with('error',translate('There are Some Problem. Please try again'));
        }
    }

    //update brand
    public function update(Request $request)
    {
        $request->validate([
            'name'=>'required',
        ]);
         $imageName = null;
        try{
            if($request->hasFile('newImage')){
                //delete old image
                try {
                    $path = 'uploads/brand/'.$request->image;
                    if(file_exists($path)){
                        unlink($path);
                    }
                }catch (\Exception $e){}
             //upload new image
                $image = $request->file('newImage');
                $imageName = Str::slug($request->name).'.'.$image->getClientOriginalExtension();
                $image->move(public_path('uploads/brand'),$imageName);
            }else{
                $imageName = $request->image;
            }

            $brand = Brand::where('id',$request->id)->update([
               'name' => $request->name,
               'slug' => Str::slug($request->name),
               'image' => $imageName,
            ]);
            if ($brand) {
                return redirect()->back()->with('success', translate('Brand Update Successfully'));
            } else {
                return redirect()->back()->with('failed', translate('There are Some Problem Try again'));
            }
        }catch (\Exception $exception){
            return redirect()->back()->with('error',translate('There are Some Problem. Please try again'));
        }
    }

    //soft delete the brand
    public function destroy($id)
    {
        try{
            if (Brand::where('id',$id)->delete()) {
                return redirect()->back()->with('success', translate('Brand Delete Successfully'));
            } else {
                return redirect()->back()->with('failed', translate('There are Some Problem Try again'));
            }
        }catch (\Exception $exception){
            return redirect()->back()->with('error',translate('There are Some Problem. Please try again'));
        }
    }
}
