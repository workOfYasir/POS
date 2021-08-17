<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\SaleProduct;
use App\Model\Sale;
use App\Model\Quotation;
use App\Model\QuotationProducts;
use App\Model\ProductStock;
use Exception;
use Illuminate\Http\Request;
use App\Model\Customer;
use Illuminate\Support\Facades\Auth;
use DB;

class QuotationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //show all quotation
    public function index(Request $request)
    {
        $quotations = null;
        if ($request->get('search')) {
            $quotations = Quotation::where('name', 'like', '%' . $request->get('search') . '%')
                ->orWhere('phone', 'like', '%' . $request->get('search') . '%')
                ->with('user')->orderByDesc('id')->paginate(10);
        } else {
            $quotations = Quotation::with('user')->orderByDesc('id')->paginate(10);
        }
        $quotations = Quotation::with('user')->orderByDesc('id')->paginate(10);
        return view('product.quotation.index')->with('quotations', $quotations);
    }

    //create page
    public function create()
    {
        $products = Product::where('is_published', true)->get();
        return view('product.quotation.create')->with('products', $products);
    }

    //store the quotation with data
    public function store(Request $request)
    {
        //validate the user input data
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'proId' => 'required',
            'proQuantity' => 'required',
        ]);

        // try {
          // echo  dd();
            //append input data in quotation
            $quotation = new Quotation();
            $quotation->name = $request->name;
            $quotation->phone = $request->phone;
            $quotation->description = $request->description;
            $quotation->discount = $request->discount;
            $quotation->create_by = Auth::id();
            if ($quotation->save()) {

                //  there are the product save
                $totalPrice = 0;
                $i = 0;
                foreach ($request->proId as $id) {
                    $pro = Product::find($id);
                    $totalPrice = $totalPrice + ($pro->price * $request->proQuantity[$i]);
                   
                    //add product details in quotation
                    $quotationPro = new QuotationProducts();
                    $quotationPro->product_id = $pro->id;
                    $quotationPro->quotation_id = $quotation->id;
                    $quotationPro->unit_price = $pro->price;
                    $quotationPro->quantity = ($request->proQuantity[$i]);
                    $quotationPro->sub_price = ($pro->price * $request->proQuantity[$i]);
                    $quotationPro->save();
                    $i++;
                }
                $totalPrice = $totalPrice - $request->discount;
                //update the amount
                Quotation::where('id', $quotation->id)->update([
                    'total_price' => $totalPrice
                ]);

                //print a quotation page for customer
                return redirect(route('quotations.print', $quotation->id));
            } else {
                return redirect()->back()->with('error', translate('There test are Some Problem. Please try again'));
            }

        // } catch (Exception $exception) {
        //     return redirect()->back()->with('error', translate('There are Some Problem. Please try again'));
        // }
    }

    //show the quotation with
    // product or calculation
    public function show($id)
    {
        try {
            $quotation = Quotation::with('user')->with('quotationProducts')->find($id);
            return view('product.quotation.show')->with('quotation', $quotation);
        } catch (Exception $exception) {
            return redirect()->back()->with('error', translate('There are Some Problem. Please try again'));
        }
    }

    //soft delete the quotation with details
    public function destroy($id)
    {
        try {
            if (Quotation::where('id', $id)->delete() && QuotationProducts::where('quotation_id', $id)->delete()) {
                return redirect()->back()->with('success', translate('Quotation Delete Successfully'));
            } else {
                return redirect()->back()->with('failed', translate('There are Some Problem Try again'));
            }
        } catch (Exception $exception) {
            return redirect()->back()->with('error', translate('There are Some Problem. Please try again'));
        }
    }

    //print quotation with details
    public function printQuotation($id)
    {
        try {

            $quotation = Quotation::with('user')->with('quotationProducts')->find($id);
            return view('product.quotation.print')->with('quotation', $quotation);
        } catch (Exception $exception) {
            return redirect()->back()->with('error', translate('There are Some Problem. Please try again'));
        }
    }

    //api call only single product
    public function singleProduct($id)
    {
        $product = Product::find($id);
        return response($product, 200);
    }
    public function addSaleShow($id){
       // try {
            //echo($id);
            $quotation = Quotation::with('user')->with('quotationProducts')->find($id);
            $customers = Customer::all();
            $quotationProducts= QuotationProducts::select('product_id')->where('quotation_id', $id)->get();
            foreach($quotationProducts as $row ){
               $product_id = $row->product_id;
            }

            //$products = ProductStock::select('warehouse_id')->where('product_id', $quotationProducts)->get();
            $sql = "SELECT * FROM `product_stocks` WHERE `product_id` = $product_id";

            $results = DB::select($sql);
            // echo "<pre>";
            // print_r($results) ;
            // echo "</pre>"; dd();
            return view('product.quotation.addSale')
                ->with('quotation', $quotation)
                ->with('customers', $customers)
                ->with('product', $results);
    //     } catch (Exception $exception) {
    //         return redirect()->back()->with('error', translate('There are Some Problem. Please try again'));
    //    }
    }
    public function saleStore(Request $request){
            
            //save the  sales required details
           // print_r($request->warehouse); dd();
        try{
            // foreach ($request->product_id as $id) {
            //     $p = ProductStock::where(['product_id' => $id ])->first();
            //     $quantity = $p->quantity;
            //     if ($quantity <= 0){
            //         return redirect()->back()->with('error', translate('There are Some Problem. Please try again if condition'));
            //     }
            // }
            $sale = new Sale();
            $sale->customer_id = $request->customer_id == 0 ? null : $request->customer_id;
            $sale->create_by = Auth::id();
            $total_item = 0;
            $sale->discount =  $request->discount;
            $sale->total_price = $request->total_price; 
            $sale->total_tax = $request->totalTax; 
            $tot=$request->total_price;
            $dis=$request->discount;
            $price= $tot + $dis;
            $sale->price = $price;
            $sale->save();
            $i = 0;

            //store the product price and quantity
            //create product sale log
           
            foreach ($request->product_id as $id) {
                 $pro = Product::find($id);
                 $proUnitPrice = $pro->unit_price;
                //  print_r($request->warehouse[$i]); dd();
                // $total_price = $total_price + ($request->unit_price[$i] * $request->proQuantity[$i]);
                // $total_item += $request->proQuantity[$i];
                //save the sales product log
                $saleProduct = new SaleProduct();
                $saleProduct->sale_id = $sale->id;
                $saleProduct->product_id = $pro->id;
                $saleProduct->quantity = $request->quantity[$i];
                $saleProduct->unit_price = $request->unit_price[$i] ;
                $saleProduct->sub_price = $request->sub_price[$i]; //multiply the price or quantity
                $saleProduct->cost_price_total = ($request->cost * $request->quantity[$i]); //multiply the cost price or quantity for log
                $saleProduct->tax_id = $pro->tax_id;
                //echo $request->unit_price[$i]; dd();
                $taxAmount = ($request->unit_price[$i] - $proUnitPrice) * $request->quantity[$i] ;
                $saleProduct->tax_amount = $taxAmount;
                
                $saleProduct->warehouse_id = $request->warehouse[$i]; // link the warehouse id ;
                $saleProduct->save();
                $p = ProductStock::where(['product_id' => $id, 'warehouse_id' => $request->warehouse[$i]])->first();
                $q = ($p->quantity - $request->quantity[$i]);
                ProductStock::where('id', $p->id)->update([
                    'quantity' => $q
                ]);
                $i++;
            }
            if ($request->customer_id != null && $request->customer_id != 0) {
                $customer = Customer::findOrFail($request->customer_id);
                // if ($customer->email) {
                //     $name=$customer->name;
                //      $customer->notify(new Invoice($name)); 
                    
                // }
            }

        //generate the invoice
        return redirect()->route('sales.invoices', [$sale->id]);
        } catch (Exception $exception) {
             //return $exception->getMessage();
            return redirect()->back()->with('error', translate('There are Some Problem. Please try again' ));
      }
        
    }
}
