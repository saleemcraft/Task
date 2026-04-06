@extends('layouts.app')
@section('main')

<div class="row">
        <div class="d-flex justify-content-between">
          <h5><i class="bi bi-journal-richtext"></i>Product Details</h5>
          <a href="{{ route('products.create') }}" class="btn btn-primary"
            ><i class="bi bi-plus-circle"></i>New Product</a
          >
        </div>
        <div class="col-md-12 table-responsive mt-3">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>S.No</th>
                <th>Image</th>
                <th>Product Name</th>
                <th>M.R.P</th>
                <th>Selling Price</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                @php
                $index=($products->currentPage() - 1) * $products->perPage() + $loop->iteration;
                @endphp
                <tr>
                <td>{{$index}}</td>
                <td>
                  <img
                    src="{{asset('products/'.$product->image)}}"
                    style="width: 50px; height:50px; object-fit:contain"
                    alt="Product"
                  />
                </td>
                <td><a href="{{ route('products.show', $product->id) }}">{{$product->name}}</a></td>
                <td>{{$product->mrp}}</td>
                <td>{{$product->price}}</td>
                <td>
                  <a href="{{ route('products.edit', $product->id) }}" class="btn btn-dark btn-sm">
                    <i class="bi bi-pencil-square"></i
                  ></a>
                  <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are You Sure Want to Delete?')" 
                                        class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
              @endforeach
            </tbody>
          </table>
          {{$products->links()}}
        </div>
        <!--row end-->

@endsection