<?php

namespace App\Http\Controllers\UserManager;

use App\Group;
use App\Http\Controllers\Controller;
use App\User;
use App\UserHasGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    //show the users with register group
    public  function index(){
        $users = User::with('groups')->get();
        return view('userManager.user.index')->with('users',$users);
    }

    //user create page
    public function create(){
        $groups = Group::all();
        return view('userManager.user.create')->with('groups',$groups);
    }

    //new user create with group
    public function store(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'unique:users'],
        ]);
        $user =new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        //upload the image
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = $user->email.'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads/users'),$imageName);
            $user->image = $imageName;
        }

        if ($user->save()) {
            //add the group
            if($request->group_id != null){
                $user->assignGroup($request->group_id);
                return redirect()->route('users.index')->with('success', translate('User Create With Permission Successfully'));
            }
            return redirect()->route('users.show')->with('success', translate('User Create Successfully'));
        } else {
            return redirect()->back()->with('failed',translate('There are Some Problem Try again '));
        }
    }

    //show the user with details
    public  function show($id){
        try{
            $user = User::where('id',$id)->with('groups')->first();
            return view('userManager.user.show')->with('user',$user);
        }catch(Exception $e){
            return redirect()->back()->with('failed',translate('There are Some Problem Try again '));
        }
    }

    //edit users with groups
    public function edit($id)
    {
        try{
            $groupss =Group::all();
            $user = User::where('id',$id)->with('groups')->first();
            return view('userManager.user.edit')->with('user',$user)->with('groupss',$groupss);
        }catch(Exception $e){
            return redirect()->back()->with('failed',translate('There are Some Problem Try again '));
        }
    }

    //update the user details
    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required'],
            'id' => 'required',
        ]);
        try {
            if($request->hasFile('newImage')){
                //delete old image
                try {
                    $path = 'uploads/users/'.$request->image;
                    if(file_exists($path)){
                        unlink($path);
                    }
                }catch (\Exception $e){}
                //upload new image
                $image = $request->file('newImage');
                $imageName = $request->email.'.'.$image->getClientOriginalExtension();
                $image->move(public_path('uploads/users'),$imageName);
            }else{
                $imageName = $request->image;
            }
            $user = User::where('id', $request->id)->update([
                'name' => $request->name,
                'image' =>$imageName,
                'email' =>$request->email,
                'phone' =>$request->phone,
            ]);
            //delete old data form group_has_permission table
            UserHasGroup::where('user_id',$request->id)->delete();
            //after delete add new data in group_has_permission table
            if ($request->group_id != null){
                foreach ($request->group_id as $id){
                    $gpc = new UserHasGroup();
                    $gpc->group_id = $id;
                    $gpc->user_id = $request->id;
                    $gpc->save();
                }
            }
            if ($user) {
                return redirect()->route('users.show',$request->id)->with('success',translate('User Update Successfully'));
            } else {
                return redirect()->back()->with('failed',translate('There are Some Problem Try again '));
            }
        } catch (Exception $e) {
            return redirect()->back()->with('failed', translate('There are Some Problem Try again '));
        }

    }

    //soft delete user
    public function destroy($id)
    {
        try{
            if (User::where('id', $id)->delete() || UserHasGroup::where('user_id',$id)->delete())  {
                return redirect()->back()->with('success',translate('User Delete Successfully'));
            } else {
                return redirect()->back()->with('failed', translate('There are Some Problem Try again'));
            }
        }catch(Exception $e){
            return redirect()->back()->with('failed',translate('There are Some Problem Try again '));
        }
    }
}
