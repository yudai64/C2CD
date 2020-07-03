@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ショッピングカート</div>

                <div class="card-body">
                @if(count($products) === 0)
                <p class="mx-auto">現在、カートに商品は入っていません</p>
                @else
                  <div class="">
                    @foreach($products as $product)
                    <div class="mt-3 border w-75 mx-auto">
                      <div class="float-left">
                        <a href="http://127.0.0.1:8000/product/{{ $product->id}}">
                          <img src="http://127.0.0.1:8000/{{ $product->image}}" width="200" height="200">
                        </a>
                      </div>
                      <div class="clearfix">
                        <p class="text-center mt-5">{{ $product->product_name }}</p>
                        <p class="text-center">{{ $product->price }}円 × {{ $product->amount }}個</p>
                      </div>

                    </div>
                    @endforeach

                    @if($total_price)
                      <p class="text-center mt-5">合計金額: {{ $total_price }}円</p>
                    @endif
                  </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
