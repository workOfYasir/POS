<?php

namespace App\Http\Controllers\Stock;

use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\ProductStock;
use App\Model\Stock;
use App\Model\StockProduct;
use App\Model\WareHouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

class StockController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //list stock transfer
    public function index()
    {

        $stocks = Stock::with('toWarehouse')->with('fromWarehouse')->orderByDesc('id')->paginate(10);
        return view('stock.index')->with('stocks', $stocks);
    }

    //stock transfer page
    public function create()
    {
        $products = Product::where('is_published', true)->get();
        $warehouses = WareHouse::all();
        return view('stock.create')->with('warehouses', $warehouses)->with('products', $products);
    }

    //store the stock with details
    public function store(Request $request)
    {
        //there are the validate the user input
        $request->validate([
            'to_warehouse' => 'required',
            'from_warehouse' => 'required',
            'shipping_cost' => 'required',
            'proId' => 'required',
            'proQuantity' => 'required',
        ]);
        try {
            //append the data in stock object
            $stock = new Stock();
            $stock->to_warehouse = $request->to_warehouse;
            $stock->from_warehouse = $request->from_warehouse;
            $stock->shipping_cost = $request->shipping_cost;
            $stock->description = $request->description;
            $stock->create_by = Auth::id();

            //upload the document
            if ($request->hasFile('document')) {
                $file = $request->file('document');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/stock'), $filename);
                $stock->document = $filename;
            }

            if ($stock->save()) {

                // there are the stock product details  save
                $totalPrice = 0;
                $i = 0;
                foreach ($request->proId as $id) {

                    //get Product Stock for  update
                    $proStock = ProductStock::where('id', $id)->first();
                    $pro = Product::find($proStock->product_id);
                    $totalPrice = $totalPrice + ($pro->price * $request->proQuantity[$i]); //calculate the total price

                    //save the stock product in database
                    $stockProduct = new StockProduct();
                    $stockProduct->product_id = $pro->id;
                    $stockProduct->stock_id = $stock->id;
                    $stockProduct->unit_price = $pro->price;
                    $stockProduct->quantity = ($request->proQuantity[$i]);

                    //calculate the price or quantity
                    $stockProduct->sub_price = ($pro->price * $request->proQuantity[$i]);
                    $stockProduct->save();

                    //update or  product quantity
                    //for from warehouse
                    $proStock1 = ProductStock::where(['product_id' => $proStock->product_id, 'warehouse_id' => $request->from_warehouse])->first();
                    if ($proStock1 != null) {

                        //update here the product stock
                        ProductStock::where('id', $proStock1->id)->update([
                            'quantity' => ($proStock1->quantity - $request->proQuantity[$i]),
                        ]);
                    }
                    //update or  product quantity
                    //for to warehouse
                    $proStock2 = ProductStock::where(['product_id' => $proStock->product_id, 'warehouse_id' => $request->to_warehouse])->first();
                    if ($proStock2 != null) {
                        ProductStock::where('id', $proStock2->id)->update([
                            'quantity' => ($proStock2->quantity + $request->proQuantity[$i]),
                        ]);
                    } else {

                        //create here product stock
                        $proStockC = new ProductStock();
                        $proStockC->product_id = $pro->id;
                        $proStockC->warehouse_id = $request->to_warehouse;
                        $proStockC->quantity = $request->proQuantity[$i];
                        $proStockC->save();
                    }
                    $i++;
                }
                //save the total price in transfer stock from - to
                Stock::where('id', $stock->id)->update([
                    'total_amount' => $totalPrice
                ]);
                return redirect()->back()->with('success', translate('Stock Transfer Created Successfully'));
            } else {
                return redirect()->back()->with('error', translate('There are Some Problem. Please try again'));
            }
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', translate('There are Some Problem. Please try again'));
        }
    }

//show the stock history
    public function show($id)
    {
        try {
            $stock = Stock::with('toWarehouse')->with('fromWarehouse')->with('stockProducts')->find($id);
            return view('stock.show')->with('stock', $stock);
        } catch (Exception $exception) {
            return redirect()->back()->with('error', translate('There are Some Problem. Please try again'));
        }

    }

    //soft delete the stock
    public function destroy($id)
    {
        try {
            if (Stock::where('id', $id)->delete() && StockProduct::where('stock_id', $id)->delete()) {
                return redirect()->back()->with('success', translate('Stock Transfer Delete Successfully'));
            } else {
                return redirect()->back()->with('failed', translate('There are Some Problem Try again'));
            }
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', translate('There are Some Problem. Please try again'));
        }
    }

    //api call for single product
    public function singleProduct($id)
    {
        $product = ProductStock::with('product')->with('warehouse')->find($id);
        return response($product, 200);
    }

    //api call for warehouse by product list
    public function optionList($id)
    {
        $products = ProductStock::where('warehouse_id', $id)->with('product')->with('warehouse')->get();
        return response($products, 200);
    }
}
