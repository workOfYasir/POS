<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Product;
use App\Model\ProductStock;
use App\Model\Purchase;
use App\Model\PurchaseProduct;
use App\Model\Quotation;
use App\Model\QuotationProducts;
use App\Model\SaleProduct;
use App\Model\StockProduct;
use App\Model\Tax;
use App\Model\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Mockery\Exception;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //show product list
    public function index(Request $request)
    {
        $products = null;
        if ($request->get('search')) {
            $search = $request->search;
            $products = Product::where('name', 'like', '%' . $search . '%')->with('category')
                ->with('brand')
                ->with('unit')
                ->with('tax')
                ->orderByDesc('id')->paginate(10);
        } else {
            $products = Product::with('category')
                ->with('brand')
                ->with('unit')
                ->with('tax')
                ->orderByDesc('id')->paginate(10);
        }
        return view('product.product.index')->with('products', $products);
    }

    //create page for product
    public function create()
    {
        $categories = Category::all();
        $units = Unit::all();
        $brands = Brand::all();
        $taxes = Tax::all();
        return view('product.product.create')
            ->with('categories', $categories)
            ->with('units', $units)
            ->with('taxes', $taxes)
            ->with('brands', $brands);
    }

    //store the Product with details
    public function store(Request $request)
    {
//        return $request;
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'cost' => 'required',
            'image' => 'required',
            'brand_id' => 'required',
            'unit_id' => 'required',
            'category_id' => 'required',
        ]);
        try {
            //append the data in product object
            $product = new Product();
            $product->name = $request->name;
            $product->slug = Str::slug($request->name);
            $product->code = $request->code == null ? Str::upper(uniqid()) : $request->code; //here ar the uniq key word for barcode
            $product->description = $request->description;
            /*check barcode active*/
            if (env('BARCODE') == "Show"){
                $bar = App::make('BarCode');
                $barcode = [
                    'text' => $product->code,
                    'size' => 80,
                    'orientation' => 'horizontal',
                    'code_type' => 'code128',
                    'print' => true,
                    'sizefactor' => 5,
                    'filename' =>  $product->code.'.jpeg'
                ];
                 $bar->barcodeFactory()->renderBarcode(
                    $text=$barcode["text"],
                    $size=$barcode['size'],
                    $orientation=$barcode['orientation'],
                    $code_type=$barcode['code_type'], // code_type : code128,code39,code128b,code128a,code25,codabar
                    $print=$barcode['print'],
                    $sizefactor=$barcode['sizefactor'],
                    $filename = $barcode['filename']
                )->filename($barcode['filename']);
            }

            //tax calculation if tax in Exclusive
            if ($request->tax_type == "Exclusive") {
                $product->unit_price = $request->price;
                $product->tax_id = $request->tax_id;
                //get tax data
                $tax = Tax::find($request->tax_id);
                //calculate tax with product sale price
                $tax_money1 = ($tax->rate * $request->price) / 100;
                $product->price = $tax_money1 + $request->price;
                //calculate tax with product cost price
                $tax_money2 = ($tax->rate * $request->cost) / 100;
                $product->cost = $tax_money2 + $request->cost;
            } else {
                //save price cost without tax
                $product->price = $request->price;
                $product->unit_price = $request->price;
                $product->cost = $request->cost;
            }
            //end tax calculation

            //append input data in product object
            $product->alert_quantity = $request->alert_quantity;
            $product->type = $request->type;
            $product->tax_type = $request->tax_type;
            $product->is_featured = $request->is_featured == "on" ? true : false;
            $product->is_published = $request->is_published == "on" ? true : false;
            $product->create_by = Auth::id();
            $product->brand_id = $request->brand_id;
            $product->unit_id = $request->unit_id;
            $product->category_id = $request->category_id;
            //upload the product image in server
            $imageName = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = $product->slug . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/product'), 
            
            );
            }
            $product->image = $imageName;
            //save the product
            if ($product->save()) {
                return redirect()->back()->with('success', translate('Product Created Successfully'));
            } else {
                return redirect()->back()->with('error', translate('There are Some Problem. Please try again'));
            }
        } catch (Exception $exception) {
            return redirect()->back()->with('error', translate('There are Some Problem. Please try again'));
        }
    }

    //show the product with details
    public function show($id)
    {
        try {
            $product = Product::with('category')
                ->with('brand')
                ->with('unit')
                ->with('tax')
                ->find($id);
            return view('product.product.show')->with('product', $product);
        } catch (Exception $exception) {
            return redirect()->back()->with('error', translate('There are Some Problem. Please try again'));
        }
    }

    //edit product
    public function edit($id)
    {
        try {
            $categories = Category::all();
            $units = Unit::all();
            $brands = Brand::all();
            $taxes = Tax::all();
            $product = Product::with('category')
                ->with('brand')
                ->with('unit')
                ->with('tax')
                ->find($id);
            return view('product.product.edit')
                ->with('product', $product)
                ->with('categories', $categories)
                ->with('units', $units)
                ->with('taxes', $taxes)
                ->with('brands', $brands);
        } catch (Exception $exception) {
            return redirect()->back()->with('error', translate('There are Some Problem. Please try again'));
        }
    }

    //update the product
    public function update(Request $request)
    {
        //validate the user input
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'cost' => 'required',
            'image' => 'required',
            'brand_id' => 'required',
            'unit_id' => 'required',
            'category_id' => 'required',
        ]);
        try {
            //image store in server
            $imageName = null;
            if ($request->hasFile('newImage')) {
                //delete old image
                try {
                    $path = 'uploads/product/' . $request->image;
                    if (file_exists($path)) {
                        unlink($path);
                    }
                } catch (\Exception $e) {
                }
                //add new image in server
                $image = $request->file('newImage');
                $imageName = Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/product'), $imageName);
            } else {
                $imageName = $request->image;
            }
            $product = Product::where('id', $request->id)->first();
            //tax calculation update
            if ($request->tax_type == "Exclusive") {
                $product->unit_price = $request->price;
                $product->tax_id = $request->tax_id;
                //get tax data
                $tax = Tax::find($request->tax_id);
                //calculate the tax with product price
                $tax_money = ($tax->rate * $request->price) / 100;
                $product->price = $tax_money + $request->price;
                //calculate the tax with product cost
                $tax_money2 = ($tax->rate * $request->cost) / 100;
                $product->cost = $tax_money2 + $request->cost;
            } else {
                //without tax
                $product->cost = $request->cost;
                $product->price = $request->price;
                $product->unit_price = $request->price;
                $product->tax_id ?? null;
            }

            if (env('BARCODE') == "Show"){
                $bar = App::make('BarCode');
                $barcode = [
                    'text' => $product->code,
                    'size' => 80,
                    'orientation' => 'horizontal',
                    'code_type' => 'code128',
                    'print' => true,
                    'sizefactor' => 2,
                    'filename' =>  $product->code.'.jpeg'
                ];
                $bar->barcodeFactory()->renderBarcode(
                    $text=$barcode["text"],
                    $size=$barcode['size'],
                    $orientation=$barcode['orientation'],
                    $code_type=$barcode['code_type'], // code_type : code128,code39,code128b,code128a,code25,codabar
                    $print=$barcode['print'],
                    $sizefactor=$barcode['sizefactor'],
                    $filename = $barcode['filename']
                )->filename($barcode['filename']);
            }
            //update the product
            $product = Product::where('id', $request->id)->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'description' => $request->description,
                'cost' => $product->cost,
                'price' => $product->price,
                'unit_price' => $product->unit_price,
                'tax_id' => $product->tax_id,
                'alert_quantity' => $request->alert_quantity,
                'type' => $request->type,
                'tax_type' => $request->tax_type,
                'is_featured' => $request->is_featured == "on" ? true : false,
                'is_published' => $request->is_published == "on" ? true : false,
                'create_by' => Auth::id(),
                'brand_id' => $request->brand_id,
                'unit_id' => $request->unit_id,
                'category_id' => $request->category_id,
                'image' => $imageName,
            ]);
            if ($product) {
                return redirect()->back()->with('success', translate('Product Update Successfully'));
            } else {
                return redirect()->back()->with('failed', translate('There are Some Problem Try again'));
            }
        } catch (Exception $exception) {
            return redirect()->back()->with('error', translate('There are Some Problem. Please try again'));
        }
    }

    //soft delete the product
    public function destroy($id)
    {
        if (SaleProduct::where('product_id', $id)->count() > 0) {
            return redirect()->back()->with('success', translate('This product used by sale history, you cannot delete it'));
        }elseif(PurchaseProduct::where('product_id',$id)->count() > 0){
            return redirect()->back()->with('success', translate('This product used by purchase history, you cannot delete it'));
        }elseif(ProductStock::where('product_id',$id)->count() > 0){
            return redirect()->back()->with('success', translate('This product used by stock history, you cannot delete it'));
        }elseif(StockProduct::where('product_id',$id)->count() > 0){
            return redirect()->back()->with('success', translate('This product used by stock history, you cannot delete it'));
        } else {
            QuotationProducts::where('product_id',$id)->forceDelete();
            if (Product::where('id', $id)->forceDelete()) {
                return redirect()->back()->with('success', translate('Product Delete Successfully'));
            } else {
                return redirect()->back()->with('failed', translate('There are Some Problem Try again'));
            }
        }
    }

    /*print the barcode*/
    public function barcode_print(Request  $request){
        if ($request->has('product_id')){
            $products = Product::whereIn('id',$request->product_id)->get();
        }else{
            $products = Product::all();
        }
        return view('product.product.barcode',compact('products'));
    }
}
