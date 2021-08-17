<?php

namespace App\Http\Controllers\Expense;

use App\Http\Controllers\Controller;
use App\Model\Expense;
use App\Model\ExpenseCategory;
use App\Model\WareHouse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //show all expense
    public function index()
    {
        $expenses = Expense::with('category')->with('warehouse')->orderByDesc('id')->paginate(10);
        return view('expense.expense.index')->with('expenses', $expenses);
    }

    //create form for expense
    public function create()
    {
        $warehouses = WareHouse::all();
        $categories = ExpenseCategory::all();
        return view('expense.expense.create')->with('warehouses', $warehouses)->with('categories', $categories);
    }

    //store expense data
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required',
        ]);
        $expense = new Expense();
        $expense->create_by = Auth::id();
        $expense->warehouse_id = $request->warehouse_id;
        $expense->category_id = $request->category_id;
        $expense->amount = $request->amount;
        $expense->description = $request->description;
        if ($expense->save()) {
            return redirect()->back()->with('success', translate('Expense  Created Successfully'));
        } else {
            return redirect()->back()->with('error', translate('There are Some Problem. Please try again'));
        }
    }

    //edit the expense data
    public function edit($id)
    {
        try {
            $warehouses = WareHouse::all();
            $categories = ExpenseCategory::all();
            $expense = Expense::with('category')->with('warehouse')->find($id);
            return view('expense.expense.edit')->with('expense', $expense)->with('warehouses', $warehouses)->with('categories', $categories);
        } catch (Exception $exception) {
            return redirect()->back()->with('error', translate('There are Some Problem. Please try again'));
        }
    }

    //update the expense data
    public function update(Request $request)
    {
        $request->validate([
            'amount' => 'required',
        ]);
        try {
            $expense = Expense::where('id', $request->id)->update([
                'amount' => $request->amount,
                'description' => $request->description,
                'warehouse_id' => $request->warehouse_id,
                'category_id' => $request->category_id,
                'create_by' => Auth::id(),
            ]);
            if ($expense) {
                return redirect()->back()->with('success', translate('Expense  Update Successfully'));
            } else {
                return redirect()->back()->with('failed', translate('There are Some Problem Try again'));
            }
        } catch (Exception $exception) {
            return redirect()->back()->with('error', translate('There are Some Problem. Please try again'));
        }
    }

    //soft delete the expense
    public function destroy($id)
    {
        try {
            if (Expense::where('id', $id)->delete()) {
                return redirect()->back()->with('success', translate('Expense  Delete Successfully'));
            } else {
                return redirect()->back()->with('failed', translate('There are Some Problem Try again'));
            }
        } catch (Exception $exception) {
            return redirect()->back()->with('error', translate('There are Some Problem. Please try again'));
        }
    }
}
