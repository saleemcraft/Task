<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index(){
        return view("auth.login");
    }

    public function registration(){
        return view("auth.registration");
    }

    

    public function postLogin(Request $request){
    $request->validate([
        'email'=>'required|email',
        'password'=>'required|min:6'
    ]);

    $credentials = $request->only('email','password');

    if(Auth::attempt($credentials)){
        // Redirect to product index page
        return redirect()->route('products.index'); 
    } else {
        return back()->with('error','Login details are not valid');
    }
}

    public function logout(){
        Auth::logout();    
        Session::flush();
        return redirect()->route('login')->with('success','Logged out successfully!');
    }

    public function dashboard(){
        return redirect()->route('products.index'); // redirect dashboard to products
    }
}