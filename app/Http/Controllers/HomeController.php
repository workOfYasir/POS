<?php

namespace App\Http\Controllers;

use App\Model\Expense;
use App\Model\Product;
use App\Model\ProductStock;
use App\Model\Purchase;
use App\Model\Sale;
use App\Notifications\Invoice;
use Carbon\Carbon;
use Faker\Provider\File;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function __construct()
    {
        Artisan::call('view:clear');
        $this->middleware('auth');
    }

   //this is show only invoice sample
    public function invoice(){
        return view('admin.include.invoice');
    }

    //show the summary of this pos
    // day, weekly, month, yearly
    public function index(Request $request)
    {
        $start1 =0;
        $end1 =0;
        if($request->input('query') == "This Week"){
            //this for week
            $start1 = Carbon::parse(date('Y-M-d'))
                ->startOfWeek()
                ->toDateTimeString();

            $end1 = Carbon::parse(date('Y-M-d'))
                ->endOfWeek()
                ->toDateTimeString();

        }elseif ($request->input('query') == "This Month"){

            //this for month
            $start1 = Carbon::parse(date('Y-M-d'))
                ->startOfMonth()
                ->toDateTimeString();
            $end1 = Carbon::parse(date('Y-M-d'))
                ->endOfMonth()
                ->toDateTimeString();
        }elseif ($request->input('query') == "This Year"){

            //this for year
            $start1 = Carbon::parse(date('Y-M-d'))
                ->startOfYear()
                ->toDateTimeString();
            $end1 = Carbon::parse(date('Y-M-d'))
                ->endOfYear()
                ->toDateTimeString();
        }else{
            //this is default current day
            $start1 = Carbon::parse(date('Y-M-d'))
                ->startOfDay()
                ->toDateTimeString();
            $end1 = Carbon::parse(date('Y-M-d'))
                ->endOfDay()
                ->toDateTimeString();
        }

        $alert_stock = Product::with('totalProductStock')->get();
       //this day total sale

        $sales = Sale::whereBetween('created_at', [$start1, $end1])->get();
        //End day total sale
        $expense = Expense::whereBetween('created_at', [$start1, $end1])->get();
        //purchase due
        $purchases = Purchase::with('supplier')->where('total_due','!=',0)->get();

        $total_sale = 0.00;
        $s =Sale::all();
        foreach ($s as $item) {
            $total_sale +=$item->total_price;
        }
        return view('admin.home.home')
            ->with('alert_products',$alert_stock)
            ->with('sales',$sales)
            ->with('purchases',$purchases)
            ->with('expense',$expense)
            ->with('total_sale',$total_sale);
    }
}
