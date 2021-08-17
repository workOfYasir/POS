<?php

namespace App\Http\Controllers\Expense;

use App\Http\Controllers\Controller;
use App\Model\ExpenseCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //shows all Expense Category
    public function index(Request $request)
    {
        $categories = null;
        if ($request->get('search')) {
            $categories = ExpenseCategory::where('name', 'like', '%' . $request->get('search') . '%')->paginate(10);
        } else {
            $categories = ExpenseCategory::paginate(10);
        }

        return view('expense.category.index')->with('categories', $categories);
    }

    //return category create form
    public function create()
    {
        return view('expense.category.create');
    }

    //store the expense category input data
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $category = new ExpenseCategory();
        $category->create_by = Auth::id();
        $category->code = $request->code;
        $category->name = $request->name;
        if ($category->save()) {
            return redirect()->back()->with('success', translate('Expense Category Created Successfully'));
        } else {
            return redirect()->back()->with('error', translate('There are Some Problem. Please try again'));
        }
    }

    //goto edit page
    public function edit($id)
    {
        try {
            $category = ExpenseCategory::find($id);
            return view('expense.category.edit')->with('category', $category);
        } catch (Exception $exception) {
            return redirect()->back()->with('error', translate('There are Some Problem. Please try again'));
        }
    }

    //update the expense category
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        try {
            $category = ExpenseCategory::where('id', $request->id)->update([
                'code' => $request->code,
                'name' => $request->name,
                'create_by' => Auth::id(),
            ]);
            if ($category) {
                return redirect()->back()->with('success', translate('Expense Category Update Successfully'));
            } else {
                return redirect()->back()->with('failed', translate('There are Some Problem Try again'));
            }
        } catch (Exception $exception) {
            return redirect()->back()->with('error', translate('There are Some Problem. Please try again'));
        }
    }

    //soft delete expense category
    public function destroy($id)
    {
        try {
            if (ExpenseCategory::where('id', $id)->delete()) {
                return redirect()->back()->with('success', translate('Expense Category Delete Successfully'));
            } else {
                return redirect()->back()->with('failed', translate('There are Some Problem Try again'));
            }
        } catch (Exception $exception) {
            return redirect()->back()->with('error', translate('There are Some Problem. Please try again'));
        }
    }
}
