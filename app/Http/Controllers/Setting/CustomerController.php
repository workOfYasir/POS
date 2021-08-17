<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Model\Customer;
use App\model\CustomerType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //customer list
    public function index(Request $request)
    {
        $customers = null;
        if ($request->get('search')) {
            $customers = Customer::where('name', 'like', '%' . $request->get('search') . '%')
                ->orWhere('number', 'like', '%' . $request->get('search') . '%')->with('user')->paginate(10);
        } else {
            $customers = Customer::with('user')->paginate(10);
        }
        return view('setting.customer.index')->with('customers', $customers);
    }

//customer create form
    public function create()
    {
        $customerType = CustomerType::all();
        return view('setting.customer.create')->with('customerType',$customerType);
    }

//store the new customer
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->number = $request->number;
        $customer->address = $request->address;
        $customer->email = $request->email;
        $customer->type = $request->type_id;
        $customer->opening_balance = $request->balance;
        $customer->create_by = Auth::id();
        if ($customer->save()) {
            return redirect()->back()->with('success', translate('Customer Created Successfully'))->with('customer', $customer);
        } else {
            return redirect()->back()->with('error', translate('There are Some Problem. Please try again'));
        }
    }

//edit the customer
    public function edit($id)
    {
        try {
            $customer = Customer::find($id);
            return view('setting.customer.edit')->with('customer', $customer);
        } catch (Exception $exception) {
            return redirect()->back()->with('error', translate('There are Some Problem. Please try again'));
        }
    }

//update the customer
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        try {
            $customer = Customer::where('id', $request->id)->update([
                'name' => $request->name,
                'number' => $request->number,
                'address' => $request->address,
                'email' => $request->email,
                'create_by' => Auth::id(),
            ]);
            if ($customer) {
                return redirect()->back()->with('success', translate('Customer Update Successfully'));
            } else {
                return redirect()->back()->with('failed', translate('There are Some Problem Try again'));
            }
        } catch (Exception $exception) {
            return redirect()->back()->with('error', translate('There are Some Problem. Please try again'));
        }
    }

    //soft delete the customer
    public function destroy($id)
    {
        try {
            if (Customer::where('id', $id)->delete()) {
                return redirect()->back()->with('success', translate('Customer Delete Successfully'));
            } else {
                return redirect()->back()->with('failed', translate('There are Some Problem Try again'));
            }
        } catch (Exception $exception) {
            return redirect()->back()->with('error', translate('There are Some Problem. Please try again'));
        }
    }
}
