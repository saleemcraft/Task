@extends('layout')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-2">
            <h2>Login Page</h2>
            @if(Session::has('success'))
            <div class="alert alert-success">{{Session::get('success')}}</div>
            @endif
            <form method="post" action="{{route('login.post')}}">
            @csrf          
            <div class="form-group row">
            <label class="col-md-4">Email</label>
            <div class="col-md-8">
                <input type="text" name="email" class="form-control" placeholder="Enter Your Email"/>
             </div>
             @if ($errors->has('email'))
             <span class="text-danger">{{$errors->first('email')}}</span>
             @endif
            </div>
            <div class="form-group row">
            <label class="col-md-4">password</label>
            <div class="col-md-8">
                <input type="text" name="password" class="form-control" placeholder="Enter Your password"/>
             </div>
             @if ($errors->has('password'))
             <span class="text-danger">{{$errors->first('password')}}</span>
             @endif
            </div>
            <div class="form-group row">
            <div class="col-md-8">
                <input type="submit" name="submit" class="btn btn-success" value="Submit"/>
             </div>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection