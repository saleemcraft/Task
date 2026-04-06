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

        $data = $request->all();
        $createUser = $this->create($data);
        return redirect('login')->withSuccess('You are Registered Successfully...');
        }

        public function create(array $data)
{
        return User::create([
            'name'=> $data['name'],
            'email'=> $data['email'],
            'password'=> Hash::make($data['password'])
  ]);

        }

public function postLogin(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);

        $checkLoginCredentials=$request->only('email','password');
        if(Auth::attempt($checkLoginCredentials)){
            return redirect()->route ('products.index')->withsuccess('You are Successfully Logged in...');
        }
        return redirect ('login')->withsuccess('You are Login Credentials are Incorrect...');
}

public function logout(){
        
        Session::flush();
        Auth::logout();    
        return redirect("login");
}



public function dashboard(){
    if(Auth::check()){
        return view ('dashboard');
    }
    return redirect ('login')->withsuccess('Please Login to Access the Dashboard Page...');
}

}
