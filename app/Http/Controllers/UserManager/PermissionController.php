<?php

namespace App\Http\Controllers\UserManager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Junges\ACL\Http\Models\Permission;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    //list of permissions
    public function index()
    {
        $permissions = Permission::all();
        return view('userManager.permission.index')->with('permissions',$permissions);
    }

   //permission create page
    public function create()
    {
        return view('userManager.permission.create');
    }
    //store permission
//     public function store(Request $request)
//     {
//         $request->validate([
//            'name'=>['required','string','unique:permissions','max:255'],
//         ]);
//         $permission = new Permission();
//         $permission->name = $request->name;
//         $permission->slug = Str::slug($request->name,'-');
//         $permission->description = $request->description ?? null;
//         if ($permission->save()) {
//             return redirect()->back()->with('success', 'Permission Create Successfully');
//         } else {
//             return redirect()->back()->with('failed', 'There are Some Problem Try again ');
//         }
//     }

//     //show the permission
//     public function show($id)
//     {
//         try{
//             $permission = Permission::where('id',$id)->first();
//             return view('userManager.permission.show')->with('permission',$permission);
//         }catch(Exception $e){
//             return redirect()->back()->with('failed', 'There are Some Problem Try again '.$e);
//         }
//     }

//     //edit permission
//     public function edit($id)
//     {
//         try{
//             $permission = Permission::where('id',$id)->first();
//             return view('userManager.permission.edit')->with('permission',$permission);
//         }catch(Exception $e){
//             return redirect()->back()->with('failed', 'There are Some Problem Try again '.$e);
//         }
//     }

//    //update the permissions
//     public function update(Request $request)
//     {
//         try {
//             $permission = Permission::where('id', $request->id)->update([
//                 'name' => $request->name,
//                 'slug' =>  Str::slug($request->name,'-'),
//                 'description' =>$request->description,
//             ]);

//             if ($permission) {
//                 return redirect()->back()->with('success', 'Permission Update Successfully');
//             } else {
//                 return redirect()->back()->with('failed', 'There are Some Problem Try again ');
//             }
//         } catch (Exception $e) {
//             return redirect()->back()->with('failed', 'There are Some Problem Try again ' . $e);
//         }
//     }

//   //delete the permissions
//     public function destroy($id)
//     {
//         try{
//             if (Permission::where('id', $id)->delete()) {
//                 return redirect()->back()->with('success', 'Permission Delete Successfully');
//             } else {
//                 return redirect()->back()->with('failed', 'There are Some Problem Try again ');
//             }
//         }catch(Exception $e){
//             return redirect()->back()->with('failed', 'There are Some Problem Try again '.$e);
//         }
//     }
}
