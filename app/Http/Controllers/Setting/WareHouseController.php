<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Model\WareHouse;
use Illuminate\Http\Request;
use Mockery\Exception;

class WareHouseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //warehouse list
    public function index()
    {
        $warehouses = WareHouse::all();
        return view('setting.warehouse.index')
            ->with('warehouses', $warehouses);
    }

    //create warehouse page
    public function create()
    {
        return view('setting.warehouse.create');
    }

    //store warehouse
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $warehouse = new WareHouse();
        $warehouse->name = $request->name;
        $warehouse->address = $request->address;
        $warehouse->phone = $request->phone;
        if ($warehouse->save()) {
            return redirect()->back()->with('success', translate('WareHouse Created Successfully'));
        } else {
            return redirect()->back()->with('error', translate('There are Some Problem. Please try again'));
        }
    }

    //warehouse edit page
    public function edit($id)
    {
        try {
            $warehouse = WareHouse::find($id);
            return view('setting.warehouse.edit')
                ->with('warehouse', $warehouse);
        } catch (Exception $exception) {
            return redirect()->back()->with('error', translate('There are Some Problem. Please try again'));
        }
    }

    //update the warehouse
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        try {
            $warehouse = WareHouse::where('id', $request->id)->update([
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
            ]);
            if ($warehouse) {
                return redirect()->back()->with('success', translate('WareHouse Update Successfully'));
            } else {
                return redirect()->back()->with('failed', translate('There are Some Problem Try again'));
            }
        } catch (Exception $exception) {
            return redirect()->back()->with('error', translate('There are Some Problem. Please try again'));
        }
    }

    //soft delete
    public function destroy($id)
    {
        try {
            if (WareHouse::where('id', $id)->delete()) {
                return redirect()->back()->with('success', translate('WareHouse Delete Successfully'));
            } else {
                return redirect()->back()->with('failed', translate('There are Some Problem Try again'));
            }
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', translate('There are Some Problem. Please try again'));
        }
    }
}
