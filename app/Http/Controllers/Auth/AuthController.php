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

    

    public function postRegistration(Request $request){
    $request->validate([
        'name'=>'required',
        'email'=>'required|email|unique:users',
        'password'=>'required|min:6',
    ]);

    User::create([
        'name'=> $request->name,
        'email'=> $request->email,
        'password'=> Hash::make($request->password)
    ]);

    // Redirect to the correct products list route
    return redirect()->route('products.index')->with('success','You are Registered Successfully...');
}

public function postLogin(Request $request){
    $request->validate([
        'email'=>'required|email',
        'password'=>'required',
    ]);

    $credentials = $request->only('email','password');
    if(Auth::attempt($credentials)){
        // Redirect to products list
        return redirect()->route('products.index')->with('success','You are Successfully Logged in...');
    }

    return redirect()->route('login')->with('error','Your Login Credentials are Incorrect...');
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