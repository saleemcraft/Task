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

        return redirect()->route('login')->with('success', 'You are Registered Successfully!');
    }

    public function postLogin(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);

        if(Auth::attempt($request->only('email','password'))){
            return redirect()->route('products.index') // ✅ Use route name
                         ->with('success','Successfully Logged in!');
        }

        return redirect()->route('login')->with('error','Login Credentials are Incorrect!');
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