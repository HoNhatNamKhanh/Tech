@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                </div>
            </div>
        </div>
    </div>
    <div>
        @foreach ($products as $product)
            <p>Product Name: {{$product->name}}</p>
            <p>Product Description: {{$product->description}}</p>
            <p>Product Image: {{$product->image}}</p>
            <p>Product Price: {{$product->price}}</p>
            <p>Product View: {{$product->view}}</p>
            <p>Product Quantity: {{$product->quantity}}</p>
            <p>Product Status: {{$product->status}}</p>
        @endforeach
        @foreach ($categories as $category)
            <h1>{{$category->name}}</h1>
        @endforeach
    </div>
</div>
@endsection