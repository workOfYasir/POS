<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\ProductStock;
use App\Model\Purchase;
use App\Model\PurchasePayment;
use App\Model\PurchaseProduct;
use App\Model\Supplier;
use App\Model\WareHouse;
use App\Notifications\PurchasInvoice;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //purchase list
    public function index()
    {
        $purchases = Purchase::with('supplier')
            ->with('warehouse')->with('user')->with('payments')
            ->with('purchaseProducts')->orderByDesc('id')->paginate(10);
        return view('purchase.index')->with('purchases', $purchases);
    }

//purchase create page
    public function create()
    {
        $warehouses = WareHouse::all();
        $products = Product::where('is_published', true)->get();
        $suppliers = Supplier::all();
        return view('purchase.create')
            ->with('warehouses', $warehouses)->with('products', $products)->with('suppliers', $suppliers);
    }

    //store the purchase with details
    public function store(Request $request)
    {
        //validate user input
        $request->validate([
            'warehouse_id' => 'required',
            'supplier_id' => 'required',
            'proId' => 'required',
            'proQuantity' => 'required',
        ]);

        try {
            //append data in purchase object
            $purchase = new Purchase();
            $purchase->warehouse_id = $request->warehouse_id;
            $purchase->create_by = Auth::id();
            $purchase->supplier_id = $request->supplier_id;
            $purchase->status = 'Received';
            $purchase->discount = $request->discount;
            $purchase->shipping_cost = $request->shipping_cost;
            $purchase->description = $request->description;

            //save document
            if ($request->hasFile('document')) {
                $file = $request->file('document');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/purchase'), $filename);
                $purchase->document = $filename;
            }

            //save the purchase
            if ($purchase->save()) {

                //  this try case for handel array exception
                $totalPrice = 0; // include discount
                $i = 0;
                foreach ($request->proId as $id) {
                    $pro = Product::find($id);

                    // calculate the purchase product total pricer
                    $totalPrice += ($pro->cost * $request->proQuantity[$i]);

                    //save the  purchase product  details in database
                    $purchasePro = new PurchaseProduct();
                    $purchasePro->product_id = $pro->id;
                    $purchasePro->purchase_id = $purchase->id;

                    //purchase product only cost price
                    $purchasePro->unit_price = $pro->cost;
                    $purchasePro->quantity = ($request->proQuantity[$i]);

                    //calculate the total product price
                    $purchasePro->sub_price = ($pro->cost * $request->proQuantity[$i]);
                    $purchasePro->save();

                    //update the product quantity in Product Stock table
                    $proStock = ProductStock::where(['product_id' => $pro->id, 'warehouse_id' => $request->warehouse_id])->first();
                    if ($proStock != null) {
                        ProductStock::where('id', $proStock->id)->update([
                            'quantity' => ($proStock->quantity + $request->proQuantity[$i]),
                        ]);
                    } else {

                        //if this product not have in stock table then create it in here
                        $proStockC = new ProductStock();
                        $proStockC->product_id = $pro->id;
                        $proStockC->warehouse_id = $request->warehouse_id;
                        $proStockC->quantity = $request->proQuantity[$i];
                        $proStockC->save();
                    }
                    $i++;
                }

                //discount calculation
                if ($request->discount != null) {
                    $totalPrice -= $request->discount;
                }

                //there are the payment statement
                $purchasePayment = new PurchasePayment();
                $purchasePayment->paid_amount = $request->paid;

                //calculate the due for purchase payment
                $purchasePayment->due_amount = ($request->paid - $totalPrice);
                $purchasePayment->create_by = Auth::id();
                $purchasePayment->purchase_id = $purchase->id;
                $purchasePayment->save();

                //note shipping cost not minus from total_amount
                //update the purchase calculate and update here
                Purchase::where('id', $purchase->id)->update([
                    'total_amount' => $totalPrice,
                    'total_paid' => $request->paid,
                    'total_due' => $purchasePayment->due_amount,
                ]);

                //sand mail to Supplier or Admin
                $this->SendMailSupplierOrAdmin($request->supplier_id, Auth::id());
                return redirect()->back()->with('success', translate('Your Purchase data save in Successfully'));

            } else {
                return redirect()->back()->with('error', translate('There are Some Problem. Please try again'));
            }

        } catch (Exception $exception) {
            return redirect()->back()->with('error', translate('There are Some Problem. Please try again'));
        }
    }

    //show purchase with all details or logs
    public function show($id)
    {
        try {
            $purchase = Purchase::with('supplier')
                ->with('warehouse')->with('user')->with('payments')
                ->with('purchaseProducts')->find($id);
            return view('purchase.show')->with('purchase', $purchase);
        } catch (Exception $exception) {
            return redirect()->back()->with('error', translate('There are Some Problem. Please try again'));
        }
    }

    //soft delete the purchase
    public function destroy($id)
    {
        try {
            if (Purchase::where('id', $id)->delete() && PurchaseProduct::where('purchase_id', $id)->delete() && PurchasePayment::where('purchase_id', $id)->delete()) {
                return redirect()->back()->with('success', translate('Purchase History Delete Successfully'));
            } else {
                return redirect()->back()->with('failed', translate('There are Some Problem Try again'));
            }
        } catch (Exception $exception) {
            return redirect()->back()->with('error', translate('There are Some Problem. Please try again'));
        }
    }

    //api call for single product
    public function singleProduct($id)
    {
        $product = Product::find($id);
        return response($product, 200);
    }

    //show payment update page
    public function createPayment($id)
    {
        try {
            $purchase = Purchase::find($id);
            return view('purchase.paymentCreate')->with('purchase', $purchase);

        } catch (Exception $exception) {
            return redirect()->back()->with('error', translate('There are Some Problem. Please try again'));
        }
    }

    //store the payment history
    public function storePayment(Request $request)
    {
        $request->validate([
            'purchase_id' => 'required',
            'paid_amount' => 'required',
        ]);
        $purchase = Purchase::find($request->purchase_id);

        //payment history create
        //paid_amount is from input data
        //calculate the due
        $due = ($purchase->total_paid + intval($request->paid_amount)) - $purchase->total_amount;

        //calculate the paid amount
        $paid = ($purchase->total_paid + $request->paid_amount);

        //this condition for check if user
        // input is > due amount then its pass a message in view
        //but not update in database
        if ($due > 0) {
            return redirect()->back()->with('failed', translate('Check you payment value'));
        }

        //save purchase payment history
        $purchasePayment = new PurchasePayment();
        $purchasePayment->paid_amount = $request->paid_amount;
        $purchasePayment->due_amount = $due;
        $purchasePayment->create_by = Auth::id();
        $purchasePayment->purchase_id = $purchase->id;
        $purchasePayment->save();

        //update the total calculation in purchase table
        Purchase::where('id', $purchase->id)->update([
            'total_paid' => $paid,
            'total_due' => $due,
        ]);
        return redirect()->back()->with('success', translate('Purchase Payment History Create Successfully'));
    }


    //send mail supplier or User
    // then purchase is save in database
    public function SendMailSupplierOrAdmin($sid, $uid)
    {
        try {

            $supplier = Supplier::findOrFail($sid);
            $supplier->notify(new PurchasInvoice());
            $user = User::findOrFail($uid);
            $user->notify(new PurchasInvoice());
        } catch (Exception $exception) {

        }
    }
}
