<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Customer;
use App\Model\Product;
use App\Model\Tax;
use App\Model\ProductStock;
use App\Model\Sale;
use App\Model\SaleProduct;
use App\Notifications\Invoice;
use App\Model\SaleHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;
use PDF;
use DB;
class PosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //show the sales item here
    public function index(Request $request)
    {
        if ($request->get('search')) {
            $start = Carbon::parse(date('y-m-d', strtotime($request->get('search'))))
                ->startOfDay()
                ->toDateTimeString();

            $end = Carbon::parse(date('y-m-d', strtotime($request->get('search'))))
                ->endOfDay()
                ->toDateTimeString();
            $pos = Sale::with('customer')->with('user')->with('saleProducts')->orderByDesc('id')->whereBetween('created_at', [$start, $end])->paginate(10);
//            return [$start,$end,$pos];
        } else {
            $pos = Sale::with('customer')->with('user')->with('saleProducts')->orderByDesc('id')->paginate(10);
        }
        return view('pos.index')->with('pos', $pos);
    }
    // show
    public function show($id)
    {

        $sale = Sale::with('customer')->with('user')->with('saleProducts')->findOrFail($id);
        // foreach($sale->saleProducts as $item) {
        //     $d=$item->product->tax_id;
        //     //echo $d; dd();
        //     $tax_name = Tax::where('id', $d)->get();
            
       // }
      
        return view('pos.show')->with('pos', $sale);

    }

   
  
    //soft delete the sale/pos with products
    public function destroy($id)
    {
        try {
            
            $stockProduct = SaleProduct::where('sale_id', $id)->get();
            foreach ($stockProduct as $item) {
                //update the Products Stock table
                $p = ProductStock::where(['product_id' => $item->product_id, 'warehouse_id' => $item->warehouse_id])->first();
                $q = ($p->quantity + $item->quantity);
                ProductStock::where('id', $p->id)->update([
                    'quantity' => $q
                ]);
            }
            if (Sale::where('id', $id)->delete() && SaleProduct::where('sale_id', $id)->delete()) {
                return redirect()->back()->with('success', translate('Pos  Delete Successfully'));
            } else {
                return redirect()->back()->with('failed', translate('There are Some Problem Try again'));
            }
        } catch (Exception $exception) {
            return redirect()->back()->with('error', translate('There are Some Problem. Please try again'));
        }
    }

    // create
    public function create()
    {
        $customers = Customer::all();
        $categories = Category::all();
        $brands = Brand::all();
        $products = Product::where('is_published', 1)->with('productStock')->get();
        return view('pos.create')
            ->with('customers', $customers)->with('categories', $categories)->with('brands', $brands)->with('products', $products);
    }

    // Pos order store here
    public function store(Request $request)
    {
        //validate the purchase input
        $request->validate([
            'proId' => 'required',
            'proQuantity' => 'required',
            'warehouse_id' => 'required',
        ], [
            'proId.required' => 'Product is required',
            'proQuantity.required' => 'Product Quantity is required',
            'warehouse_id.required' => 'Warehouse is required',
        ]);
        try {
            
            //save the  sales required details
            $sale = new Sale();
            
            $sale->customer_id = $request->customer_id == 0 ? null : $request->customer_id;
            $sale->create_by = Auth::id();
            
            $total_item = 0;
            $total_price = 0;
            $totalTaxAmount = 0;
       
            $sale->save();

            $i = 0;

            //store the product price and quantity
            //create product sale log
            foreach ($request->proId as $id)
            {
                
                $pro = Product::find($id);
                $proUnitPrice = $pro->unit_price;
                $total_price = $total_price + ($request->unit_price[$i] * $request->proQuantity[$i]);
               
                $total_item += $request->proQuantity[$i];
                //save the sales product log
                
                $saleProduct = new SaleProduct();
                $saleProduct->sale_id = $sale->id;
                $saleProduct->product_id = $pro->id;
                $saleProduct->quantity = $request->proQuantity[$i];
                $saleProduct->unit_price = $request->unit_price[$i];
                $saleProduct->sub_price = ($request->unit_price[$i]  * $request->proQuantity[$i]); //multiply the price or quantity
                $saleProduct->cost_price_total = ($pro->cost * $request->proQuantity[$i]); //multiply the cost price or quantity for log
                $saleProduct->tax_id = $pro->tax_id;
                $taxAmount = ($request->unit_price[$i] - $proUnitPrice) * $request->proQuantity[$i] ;
                $saleProduct->tax_amount = $taxAmount;
                $totalTaxAmount = $totalTaxAmount + $taxAmount;
                $saleProduct->warehouse_id = $request->warehouse_id[$i]; // link the warehouse id ;
                $saleProduct->save();
                //update the Products Stock table
                $p = ProductStock::where(['product_id' => $id, 'warehouse_id' => $request->warehouse_id[$i]])->first();
                $q = ($p->quantity - $request->proQuantity[$i]);
                ProductStock::where('id', $p->id)->update([
                    'quantity' => $q
                ]);
                $i++;


            } 
                
                //update the sales with final calculate amount
                //if have discount then minus it otherwise only input hte total_price
                Sale::where('id', $sale->id)->update([
                    'total_price' => $request->discount == null ? $total_price : $total_price - $request->discount, //if have discount then minus it otherwise only input hte total_price
                    'balance' => $request->discount == null ? $total_price : $total_price - $request->discount, //if have discount then minus it otherwise only input hte total_price
                    'discount' => $request->discount,
                    'total_tax' => $totalTaxAmount,
                    'price' => $total_price,
                    'total_item' => $total_item,
                ]);
                $saleInstallments = new SaleHistory();
                $saleInstallments->credit = $request->discount == null ? $total_price : $total_price - $request->discount;
                $saleInstallments->customer_id = $request->customer_id == 0 ? null : $request->customer_id;
                $saleInstallments->sale_id = $sale->id;
                $saleInstallments->balance = $request->discount == null ? $total_price : $total_price - $request->discount;
                $saleInstallments->save();
                //send the invoice mail if customer have
                if ($request->customer_id != null && $request->customer_id != 0) {
                    $customer = Customer::findOrFail($request->customer_id);
                    if ($customer->email) {
                        $name=$customer->name;
                        $customer->notify(new Invoice($name)); 
                        
                    }
                }

             //generate the invoice
             return redirect()->route('sales.invoices', [$sale->id]);

        } catch (Exception $exception) {
            return redirect()->back()->with('error', translate('There are Some Problem. Please try again'));
        }
    }

    //print a invoice function
    public function salePrint($id)
    {
        $sales = Sale::with('saleProducts')->with('customer')->findOrFail($id);
        return view('pos.invoice')->with('sales', $sales);
    }

    //ajax call for single  product
    public function singleProduct($id)
    {

        $product = Product::with('productStock')->find($id);
        return response($product, 200);
    }

    public  function singleProductBarcode($id){
        $product = Product::where('code',$id)->with('productStock')->first();
        return response($product, 200);
    }

    //ajax call for category base products
    public function posProduct(Request $request)
    {
        //todo::there change category child category
        $products = Product::with('productStock');

        if ($request->categoryId != 0) {
            $products = $products->where('category_id', $request->categoryId);
        }
        if ($request->brandId != 0) {
            $products = $products->where('brand_id', $request->brandId);
        }
        return response(ProductCollection::collection($products->get()), 200);
    }

    /*multipleInvoice*/
    public function  multipleInvoice(Request  $request){
        if ($request->invoice_id == null) {
            return back();
        }
        $ids = array();
        foreach ($request->invoice_id as $id){
            array_push($ids,(int)$id);
        }
        $sales =Sale::whereIn('id',$ids)->with('saleProducts')->with('customer')->get();
        return view('pos.invoice_multi')->with('sales', $sales);
    }
    
    public function statusEdit($id){
        $status = Sale::find($id);
        return view('pos.status_update')->with('status', $status);
    }

    public function statusUpdate(Request  $request){
        $current = Carbon::now();
        $current = new Carbon();
       // echo $current; dd();
        $saleProduct = $request->status;
        $statusUpdatedBy = Auth::id();
        $payment = $request->payment;
        $reference = $request->reference;
        $followComment = $request->followComment;
        //echo $followComment, $saleProduct,$statusUpdatedBy ; dd();
        $status = Sale::where('id', $request->id)->update([
                'status' => $saleProduct,
                'paid_at'=>$current,
                'status_updated_by'=>$statusUpdatedBy,
                'payment_method'=>$payment,
                'payment_reference'=>$reference,
                'follow_comment'=>$followComment,
            ]);

        // $pos = Sale::with('customer')->with('user')->with('saleProducts')->orderByDesc('id')->paginate(10);
        // return view('pos.index')->with('pos', $pos);
        return redirect()->route('poses.index');
    }

    public function edit($id){
        
        $comment = Sale::find($id);
        return view('report.commentEdit')->with('comment', $comment);    
    }

    public function commentUpdate(Request $request){
        $followComment = $request->followComment;
        $status = Sale::where('id', $request->id)->update([
                'follow_comment'=>$followComment,
            ]);
        $reciveable = Sale::with('customer')->with('user')->where('status', 'reciveable')->get();
        return view('report.reciveable')
            ->with('reciveable', $reciveable);    
    }
    public function installment($id){
       

        $installmentData = Sale::find($id);
        
        return view('pos.installment')->with('installmentData', $installmentData); 
    }
    public function storeInstallment(Request $request){
        $saleInstallment = new SaleHistory();
        $saleInstallment->sale_id = $request->sale_id;
        $saleInstallment->customer_id = $request->customer_id; 
        $saleInstallment->debit = $request->debit;

        $balanceOld = $request->balance;
        $balance = $balanceOld-$saleInstallment->debit;
        $saleInstallment->balance=$balance;
        $balanceAmount = Sale::where('id', $request->sale_id)->update([
                'balance'=>$balance,
            ]);
        
        $saleInstallment->save();
        if ($request->get('search')) {
            $start = Carbon::parse(date('y-m-d', strtotime($request->get('search'))))
                ->startOfDay()
                ->toDateTimeString();

            $end = Carbon::parse(date('y-m-d', strtotime($request->get('search'))))
                ->endOfDay()
                ->toDateTimeString();
            $pos = Sale::with('customer')->with('user')->with('saleProducts')->orderByDesc('id')->whereBetween('created_at', [$start, $end])->paginate(10);

        } else {
            $pos = Sale::with('customer')->with('user')->with('saleProducts')->orderByDesc('id')->paginate(10);
        }
        return view('pos.index')->with('pos', $pos);

    }
    public function showInstallment(Request $request){
        $customerData = Customer::all();
        if(!empty($request->customer_id)){
            
            $ledger = SaleHistory::where('customer_id' , $request->customer_id)->get();
           
            return view('pos.ledger')->with('ledger',$ledger)->with('customerData',$customerData);

        }else{
            return view('pos.ledger')->with('customerData',$customerData);
        }
        
       
    }

}
