<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //show login form
    public function showLoginForm(){
        if(Auth::check()){
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    //check the login inputs, need email or password to login
    //user can login belong information email,name,phone
    //password need mandatory
    public function login(Request $request){
        $request->validate([
           'email'=>'required',
           'password'=>'required'
        ]);
        $user = User::where('email',$request->email)->orWhere('phone',$request->email)->first();
        if($user != null){
            //here hash password
            if (Hash::check($request->password, $user->password)){
                if($request->has('remember')){
                    auth()->login($user, true);
                }else{
                    auth()->login($user,false);
                }
                return redirect()->route('dashboard');
            }
        }
        return back()->with('error',translate('Login Information Wrong'));
    }

    //this function for logout
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/');
    }

    protected function guard()
    {
        return Auth::guard();
    }

    //change password view
    // with authenticate user
    public function passwordChange($id){
        if ($id == Auth::id()){
            $user = Auth::user();
            return view('auth.passwords.confirm_password')->with('user',$user);
        }
        return redirect()->back()->with('failed', translate('There are Some Problem Try again '));
    }

    //password update function
    public function passwordUpdate(Request $request){
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        if ($request->id == Auth::id()){
            //update the password
            $user = User::where('id', $request->id)->update([
                'password' =>Hash::make($request->password),
            ]);
            if ($user){
            return redirect()->back()->with('success',translate('Password is Successfully Change'));
            }
            return view('auth.passwords.confirm_password')->with('failed', translate('There are Some Problem Try again '));
        }
        return redirect()->back()->with('failed', translate('There are Some Problem Try again '));
    }


    public function loggedOut(Request $request)
    {
      return redirect('/');
    }

}
