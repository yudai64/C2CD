@extends('layouts.app')

@section('content')
<div class="container">
<div class="row mx-auto mt-3">
            @foreach($products as $product)
            <div class="col-md-3 mt-5 text-center">
                    <a href="http://127.0.0.1:8000/product/{{ $product->id}}">
                    <img src="{{ $product->image}}" width="250" height="250">
                    </a>
                    <div class="mt-2 mx-auto">
                        {{ $product->product_name}}</br>
                        {{ $product->price}}円
                    </div>
            </div>
            @endforeach
</div>
<div class="mx-auto mt-4" style="width: 200px;">{{ $products->links() }}</div>
</div>
@endsection
