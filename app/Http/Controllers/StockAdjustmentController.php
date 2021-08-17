<?php

namespace App\Http\Controllers;

use App\Model\Product;
use App\Model\ProductStock;
use App\Model\ReturnProduct;
use App\Model\Sale;
use App\Model\SaleProduct;
use App\Model\StockAdjustment;
use App\Model\StockAdjustmentProduct;
use App\Model\WareHouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StockAdjustmentController extends Controller
{
    //stock adjustment
    public function index(){
        $stocks = StockAdjustment::with('adjustmentProduct')->paginate(10);
        return view('stockAdjustment.index',compact('stocks'));
    }


    public function create(){
        $warehouses = WareHouse::all();
        $products = Product::where('is_published',1)->get();
        return view('stockAdjustment.create',compact('warehouses','products'));
    }


    /*stock store tor adjust in stock*/
    public function store(Request  $request){

        $stock =new StockAdjustment();
        $stock->warehouse_id =$request->warehouse_id;
        $stock->confirm_by =Auth::id();
        $stock->invoice =$request->invoice;
        $stock->amount = $request->amount;
        $stock->description = $request->description;
        $stock->save();
        $i =0;
        foreach ($request->proId as $product){
            $stockAdjustmentProduct = new StockAdjustmentProduct();
            $stockAdjustmentProduct->stock_adjustment_id = $stock->id;
            $stockAdjustmentProduct->product_id = $product;
            $stockAdjustmentProduct->quantity = $request->proQuantity[$i];
            $stockAdjustmentProduct->save();
            /*here the add in stock*/
            $proStock2 = ProductStock::where(['product_id' => $product, 'warehouse_id' => $request->warehouse_id])->first();
            if ($proStock2 != null) {
                ProductStock::where('id', $proStock2->id)->update([
                    'quantity' => ($proStock2->quantity + $request->proQuantity[$i]),
                ]);
            } else {

                //create here product stock
                $proStockC = new ProductStock();
                $proStockC->product_id = $product;
                $proStockC->warehouse_id = $request->warehouse_id;
                $proStockC->quantity = $request->proQuantity[$i];
                $proStockC->save();
            }
            $i++;
        }
        return redirect()->back()->with('success', translate('Stock Adjustment Done Successfully'));
    }

    /*show*/
    public function show($id){
        $stock = StockAdjustment::find($id);

        return view('stockAdjustment.show',compact('stock'));
    }

    /*delete*/
    public function destroy($id){
        $stock = StockAdjustment::find($id);
        foreach ($stock->adjustmentProduct as $product){
            $product->delete();
        }

        $stock->delete();
        return redirect()->back()->with('success', translate('Stock Adjustment Delete Successfully'));
    }

    //api call for single product
    public function single_product($id)
    {
        $product = Product::find($id);
        return response($product, 200);
    }
    /*here are the stock return code*/

    public function returnIndex(Request $request){
        if ($request->get('search')) {

            $invoice = $request->get('search');
            $id = Str::after($invoice,'INV000');

            $pos = Sale::with('customer')->with('user')->with('saleProducts')->orderByDesc('id')->where('id', $id)->paginate(10);
        } else {
            $pos = Sale::with('customer')->with('user')->with('saleProducts')->orderByDesc('id')->paginate(10);
        }
        return view('stockAdjustment.returnIndex')->with('pos', $pos);
    }

    public function returnEdit($id){
        $pos = Sale::with('customer')->with('user')->with('saleProducts')->findOrFail($id);
        return view('stockAdjustment.returnCreate')->with('pos',$pos);
    }

    /*return confirm*/
    public function returnConfirm($id){
        $saleProduct = SaleProduct::find($id);
        /*add to stock*/
        $stock = ProductStock::where('product_id',$saleProduct->product_id)->where('warehouse_id',$saleProduct->warehouse_id)->first();
        $stock->quantity +=$saleProduct->quantity;
        $stock->save();
        /*minus sale total price*/
        $sale = Sale::where('id',$saleProduct->sale_id)->first();
        $sale->total_price -=$saleProduct->sub_price;
        $sale->price -=$saleProduct->sub_price;
        $sale->save();
        /*delete */
        $saleProduct->delete();
        /*return product save*/
        $return = new ReturnProduct();
        $return->sale_id = $saleProduct->sale_id;
        $return->product_id = $saleProduct->product_id;
        $return->quantity = $saleProduct->quantity;
        $return->amount = $saleProduct->sub_price;
        $return->user_id = Auth::id();
        $return->save();

        return back()->with('success', translate('Return Product  Successfully'));
    }

    /*return product list*/
    public function returnProductIndex(){
        $returns = ReturnProduct::with('product')->with('sale')->with('user')->orderByDesc('id')->paginate(10);
        return view('stockAdjustment.returnProductIndex',compact('returns'));
    }
}
