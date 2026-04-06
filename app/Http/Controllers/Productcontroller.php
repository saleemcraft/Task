<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    public function index(){
        $products=Product::latest()->paginate(5);
        return view('products.index',['products'=>$products]);
    }

    public function create(){
        return view('products.create'); 

    }
    public function store(Request $request)
    {
        // dd($request->all());
      $request->validate([
        'name'=>'required',
        'description'=>'required',
        'mrp'=>'required|numeric',
        'price'=>'required|numeric',
        'image'=>'required'
      ]);

      $imageName=time().".".$request->image->extension();
      $request->image->move(public_path('products'),$imageName);

      $data = $request->only([
        'name',
        'mrp',
        'price',
        'description',
        ]);
        $data['image'] = $imageName;

        Product::create($data);
        return Redirect('products')
        ->withsuccess('product added successfully');

    }

    public function show($id){
        $product=Product::where('id',$id)->first();
        return view('products.show', ['product'=>$product]);
    }

    public function edit($id){
        $product=Product::where('id',$id)->first();
        return view('products.edit', ['product'=>$product]);
    }

    public function update(Request $request,$id){
        $request->validate([
        'name'=>'required',
        'description'=>'required',
        'mrp'=>'required|numeric',
        'price'=>'required|numeric',
        'image'=>'nullable'
      ]);
        $product=Product::findOrFail($id);
        if($request->hasFile('image')){
      $imageName=time().".".$request->image->extension();
      $request->image->move(public_path('products'),$imageName);
      $product->image=$imageName;

}

        $product->name=$request->name;
        $product->mrp=$request->mrp;
        $product->price=$request->price;
        $product->description=$request->description;
        
        $product->save();
        return Redirect('products')
        ->withsuccess('product updated successfully');
         }
    
    public function destroy($id){
     $product=Product::where('id',$id)->first();
     $product->delete();
     return back()->withsuccess('product Details Deleted Successfully...!');  
    }
} 