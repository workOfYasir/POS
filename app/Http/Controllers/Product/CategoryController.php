<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Model\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //show all category
    public function index(Request $request)
    {
        $categories = null;
        if ($request->get('search')) {
            $search = $request->search;
            $categories = Category::where('name', 'like', '%' . $search . '%')->with('parent')->paginate(10);
        } else {
            $categories = Category::with('parent')->paginate(10);
        }
        return view('product.category.index')
            ->with('categories', $categories);
    }

//create page
    public function create()
    {
        $categories = Category::all();
        return view('product.category.create')->with('categories', $categories);
    }

    //store the category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->parent_category_id = $request->parent_category_id;
        //store the icon
        if ($request->hasFile('icon')) {
            $image = $request->file('icon');
            $imageName = $category->slug . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/category'), $imageName);
            $category->icon = $imageName;
        }
        if ($category->save()) {
            return redirect()->back()->with('success', translate('Category Created Successfully'));
        } else {
            return redirect()->back()->with('error', translate('There are Some Problem. Please try again'));
        }
    }

//edit page
    public function edit($id)
    {
        try {
            $category = Category::find($id);
            $categories = Category::all();
            return view('product.category.edit')
                ->with('category', $category)->with('categories', $categories);
        } catch (Exception $exception) {
            return redirect()->back()->with('error', translate('There are Some Problem. Please try again'));
        }
    }

    //update the category
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $imageName = null;
        try {
            //save or delete the icon
            if ($request->hasFile('newIcon')) {
                //delete the icon
                if ($request->icon != null) {
                    $path = 'uploads/category/' . $request->icon;
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
                //store the new icons
                $image = $request->file('newIcon');
                $imageName = Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/category'), $imageName);
            } else {
                $imageName = $request->icon;
            }
            $category = Category::where('id', $request->id)->update([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'parent_category_id' => $request->parent_category_id,
                'icon' => $imageName
            ]);
            if ($category) {
                return redirect()->back()->with('success', translate('Category Update Successfully'));
            } else {
                return redirect()->back()->with('failed', translate('There are Some Problem Try again'));
            }
        } catch (Exception $exception) {
            return redirect()->back()->with('error', translate('There are Some Problem. Please try again'));
        }
    }

    //soft delete the category
    public function destroy($id)
    {
        try {
            if (Category::where('id', $id)->delete()) {
                return redirect()->back()->with('success', translate('Category Delete Successfully'));
            } else {
                return redirect()->back()->with('failed', translate('There are Some Problem Try again'));
            }
        } catch (Exception $exception) {
            return redirect()->back()->with('error', translate('There are Some Problem. Please try again'));
        }
    }
}
