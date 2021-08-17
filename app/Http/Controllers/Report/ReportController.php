<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Expense;
use App\Model\ExpenseCategory;
use App\Model\Product;
use App\Model\ProductStock;
use App\Model\Purchase;
use App\Model\Sale;
use App\Model\SaleProduct;
use App\Model\StockAdjustment;
use App\Model\Supplier;
use App\Model\WareHouse;
use App\Model\Tax;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;
use date;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //profitLoss report Show .Filter Start date to end date
    public function profitLossReport(Request $request)
    {
        $start = Carbon::parse(date('y-m-d'))
            ->startOfMonth()
            ->toDateTimeString();
        $end = Carbon::parse(date('y-m-d'))
            ->endOfMonth()
            ->toDateTimeString();
        //date ways
        if ($request->input('start') != null && $request->input('end') != null) {
            $start = Carbon::parse($request->input('start'))
                ->startOfDay()
                ->toDateTimeString();

            $end = Carbon::parse($request->input('end'))
                ->endOfDay()
                ->toDateTimeString();
        }

        //calculate here all sale, purchase or expense
        //there are calculate (total_product_cost_price - sale_product_bay_cost)
        $sale_total_amount = Sale::whereBetween('created_at', [$start, $end])->get()->sum('total_price');
        $sale_product_list = Sale::whereBetween('created_at', [$start, $end])->with('saleProducts')->get();
        $total_product_cost_price = 0;
        foreach ($sale_product_list as $item) {
            $i = $item->saleProducts;
            foreach ($i as $product) {
                $total_product_cost_price += $product->cost_price_total;
            }
        }
        $purchase_shipping_cost = Purchase::whereBetween('created_at', [$start, $end])->get()->sum('shipping_cost');
        $expense = Expense::whereBetween('created_at', [$start, $end])->get()->sum('amount');
        $return_sale = StockAdjustment::whereBetween('created_at',[$start,$end])->get()->sum('amount');
        $process = $sale_total_amount - $total_product_cost_price;
        return view('report.profit', compact('expense', 'sale_total_amount', 'start','return_sale', 'end', 'process', 'total_product_cost_price'));
    }

    //pos report filter Start date to end date
    public function posReport(Request $request)
    {
        if ($request->input('start') != null && $request->input('end') != null) {
            $start = Carbon::parse($request->input('start'))
                ->startOfDay()        // 2018-09-29 00:00:00.000000
                ->toDateTimeString();

            $end = Carbon::parse($request->input('end'))
                ->endOfDay()          // 2018-09-29 23:59:59.000000
                ->toDateTimeString();

            $pos = Sale::with('customer')->with('user')->whereBetween('created_at', [$start, $end])->get();
            return view('report.pos')
                ->with('pos', $pos);
        } elseif ($request->input('start') != null) {
            $start = Carbon::parse($request->input('start'))
                ->startOfDay()        // 2018-09-29 00:00:00.000000
                ->toDateTimeString();
            $end = Carbon::parse($request->input('start'))
                ->endOfDay()          // 2018-09-29 23:59:59.000000
                ->toDateTimeString();
            $pos = Sale::with('customer')->with('user')->whereBetween('created_at', [$start, $end])->get();
            return view('report.pos')
                ->with('pos', $pos);
        } else {
            $pos = Sale::with('customer')->with('user')->get();
            return view('report.pos')
                ->with('pos', $pos);
        }

    }

//expense report start date to end date
// warehouse or expense category
    public function expenseReport(Request $request)
    {
        $categories = ExpenseCategory::all();
        $warehouses = WareHouse::all();

        $start1 = Carbon::parse($request->input('start'))
            ->startOfDay()        // 2018-09-29 00:00:00.000000
            ->toDateTimeString(); // 2018-09-29 00:00:00

        $end1 = Carbon::parse($request->input('end'))
            ->endOfDay()          // 2018-09-29 23:59:59.000000
            ->toDateTimeString();

        $condition = [];
        if ($request->input('warehouse_id') != null) {
            $condition = array_merge($condition, ['warehouse_id' => $request->input('warehouse_id')]);
        }
        if ($request->input('category_id') != null) {
            $condition = array_merge($condition, ['category_id' => $request->input('category_id')]);
        }

        if ($request->input('start') != null && $request->input('end') != null) {
            $expenses = Expense::whereBetween('created_at', [$start1, $end1])->where($condition)->get();
            return view('report.expense')->with('expenses', $expenses)->with('categories', $categories)->with('warehouses', $warehouses);
        } elseif ($request->input('start') != null) {
            $end1 = Carbon::parse($request->input('start'))
                ->endOfDay()          // 2018-09-29 23:59:59.000000
                ->toDateTimeString();
            $expenses = Expense::whereBetween('created_at', [$start1, $end1])->where($condition)->get();
            return view('report.expense')->with('expenses', $expenses)->with('categories', $categories)->with('warehouses', $warehouses);
        }

        $expenses = Expense::where($condition)->get();
        return view('report.expense')
            ->with('expenses', $expenses)
            ->with('categories', $categories)
            ->with('warehouses', $warehouses);
    }

    //filter only warehouse ways
    public function warehouseReport(Request $request)
    {
        $id = $request->input('warehouse_id') == null ? 0 : $request->input('warehouse_id');
        $products = ProductStock::with('product')->with('warehouse')->where('warehouse_id', $id)->get();
        $warehouses = WareHouse::all();
        return view('report.warehouse')
            ->with('products', $products)
            ->with('warehouses', $warehouses);
    }

    //filter Start date or end date, Warehouse, supplier
    public function purchaseReport(Request $request)
    {
        $start1 = Carbon::parse($request->input('start'))
            ->startOfDay()
            ->toDateTimeString();
        $end1 = Carbon::parse($request->input('end'))
            ->endOfDay()
            ->toDateTimeString();

        $condition = [];
        if ($request->input('warehouse_id') != null) {
            $condition = array_merge($condition, ['warehouse_id' => $request->input('warehouse_id')]);
        }
        if ($request->input('supplier_id') != null) {
            $condition = array_merge($condition, ['supplier_id' => $request->input('supplier_id')]);
        }
        $warehouses = WareHouse::all();
        $suppliers = Supplier::all();
        if ($request->input('start') != null && $request->input('end') != null) {
            $purchases = Purchase::whereBetween('created_at', [$start1, $end1])->where($condition)->get();
            return view('report.purchase')->with('purchases', $purchases)->with('suppliers', $suppliers)->with('warehouses', $warehouses);
        } elseif ($request->input('start') != null) {
            $end1 = Carbon::parse($request->input('start'))
                ->endOfDay()
                ->toDateTimeString();
            $purchases = Purchase::whereBetween('created_at', [$start1, $end1])->where($condition)->get();
            return view('report.purchase')->with('purchases', $purchases)->with('suppliers', $suppliers)->with('warehouses', $warehouses);
        }

        $purchases = Purchase::with('purchaseProducts')->where($condition)->get();

        return view('report.purchase')
            ->with('purchases', $purchases)
            ->with('suppliers', $suppliers)
            ->with('warehouses', $warehouses);

    }
    //stock report here user can
    //filter brand, category, warehouse in  stock product list
    public function stockReport(Request $request)
    {
        $condition = [];
        $id = [];
        if ($request->input('brand_id') != 0 || $request->input('category_id') != 0) {
            $condition = array_merge($condition, ['brand_id' => $request->input('brand_id')]);
        }
        if ($request->input('category_id') != 0) {
            $condition = array_merge($condition, ['category_id' => $request->input('category_id')]);

        }
        $pro = Product::where($condition)->get();
        foreach ($pro as $i) {
            $id = array_merge($id, [$i->id]);
        }

        $brands = Brand::all();
        $categories = Category::all();
        $warehouses = WareHouse::all();

        if ($pro == null) {
            $products = ProductStock::with('product')->with('warehouse')->where('warehouse_id', $request->input('warehouse_id'))->get();
        } else {
            if ($request->input('warehouse_id') != 0) {

                $products = ProductStock::where('warehouse_id', $request->input('warehouse_id'))->with('product')
                    ->with('warehouse')
                    ->whereIn('product_id', $id)->get();

            } else {
                $products = ProductStock::with('product')
                    ->with('warehouse')
                    ->whereIn('product_id', $id)->get();
            }
        }

        return view('report.stock')
            ->with('brands', $brands)
            ->with('categories', $categories)
            ->with('warehouses', $warehouses)
            ->with('products', $products);
    }

    public function taxReport(Request $request){

        if($request->input('start')!=Null && $request->input('end')!=NULL){

            $start = Carbon::parse($request->input('start'))
                ->startOfDay()
                ->toDateTimeString();
                
               
            $end = Carbon::parse($request->input('end'))
                ->endOfDay()
                ->toDateTimeString();
               
                // $totalTax = Sale::whereBetween('created_at', [$start, $end])->sum('total_tax');
                // echo $totalTax; dd(); 
                           
            $results = DB::select("SELECT date(created_at) AS created , SUM(total_tax) AS daily_total FROM sales WHERE date(created_at) BETWEEN '$start' and '$end' group BY date(created_at)" );
            return view('report.tax')->with('results',$results);

        } elseif ($request->input('start')!=Null){

            $start = Carbon::parse($request->input('start'))                   
                ->startOfDay()
                ->toDateTimeString();
            
            $end = Carbon::parse($request->input('start'))
                ->endOfDay()
                ->toDateTimeString();
            
            $results = DB::select("SELECT date(created_at) AS created , SUM(total_tax) AS daily_total FROM sales WHERE date(created_at) BETWEEN '$start' and '$end' group BY date(created_at)" );
                
            
            return view('report.tax')->with('results',$results);
               
            /* 
            Finding start And End of the year start:2021-01-01 00:00:00 end:2021-12-31 23:59:59
            */
        //     $start = Carbon::parse(date(2021))
        //     ->startOfYear()
        //     ->toDateTimeString();
        // $end = Carbon::parse(date(2021))
        //     ->endOfYear()
        //     ->toDateTimeString();
        //     echo $start. "<br/>" .$end; dd();
        //     $totalTax = Sale::whereBetween('created_at', [$start, $end])->sum('total_tax');
            
        } else {

        // $totalTax = Sale::whereDate('created_at', '=', Carbon::today()->toDateString()) 
        //             ->sum('total_tax')
        //             ->groupBy('created_at')
        //             ->get();
            $results = DB::select("SELECT date(created_at) AS created , 
            SUM(total_tax) AS daily_total 
            FROM sales 
            group BY date(created_at)" );
            return view('report.tax')->with('results',$results);
       }
    }
        
    public function reciveableReport(Request $request)
    {
        if ($request->input('start') != null && $request->input('end') != null) {
            $start = Carbon::parse($request->input('start'))
                ->startOfDay()        // 2018-09-29 00:00:00.000000
                ->toDateTimeString();

            $end = Carbon::parse($request->input('end'))
                ->endOfDay()          // 2018-09-29 23:59:59.000000
                ->toDateTimeString();

            $reciveable = Sale::with('customer')->with('user')->where('status', 'reciveable')->whereBetween('created_at', [$start, $end])->get();
            return view('report.reciveable')
                ->with('reciveable', $reciveable);
        } elseif ($request->input('start') != null) {
            $start = Carbon::parse($request->input('start'))
                ->startOfDay()        // 2018-09-29 00:00:00.000000
                ->toDateTimeString();
            $end = Carbon::parse($request->input('start'))
                ->endOfDay()          // 2018-09-29 23:59:59.000000
                ->toDateTimeString();
            $reciveable = Sale::with('customer')->with('user')->where('status', 'reciveable')->whereBetween('created_at', [$start, $end])->get();
            return view('report.reciveable')
                ->with('reciveable', $reciveable);
        } else {
           
            $reciveable = Sale::with('customer')->with('user')->where('status', 'reciveable')->get();
            return view('report.reciveable')
                ->with('reciveable', $reciveable);
        }

    }
    //detail report 
    public function reportBook(){
        $data = Sale::with('saleProducts')->with('user')->with('customer')->get();
        //print_r($data); dd();
        return view('report.report_book')->with('data',$data);
    }
}
