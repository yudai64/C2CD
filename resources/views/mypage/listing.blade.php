@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">商品詳細画面</div>

                <div class="card-body">
                  <div class="text-center">
                    <div class="pl-2 text-center mb-4">
                        <img src="http://127.0.0.1:8000/{{ $product->image }}" width="200" height="200">
                    </div>
                    <div class="pl-2">
                      <span id="product_name">商品名 : </span>
                      {{ $product->product_name }}
                    </div>
                    <div class="pl-2">
                      <span id="price">価格 : </span>
                      {{ $product->price }}円
                    </div>
                    <div class="pl-2">
                      <span id="amount">数量 : </span>
                      {{ $product->amount }}個
                    </div>
                    <div class="pl-2">
                      <span id="category_id">カテゴリー : </span>
                      {{ $category }}
                    </div>
                    <div class="pl-2">
                      <span id="describe">詳細 : </span>
                      {{ $product->describe }}
                    </div>
                  </div>

                    <form method="GET" action="{{$url}}" class="text-center">
                    @csrf
                      <button type="submit" class="btn btn-primary mt-3">{{ __($button) }}</button>
                    </form>

                  @if($product->status_id == 1 or $product->status_id ==2)
                  <form method="POST" action="{{ route('statusSwitch') }}" class="text-center">
                  @csrf
                    <input type="hidden" name="id" value={{ $product->id }}>
                    <button type="submit" class="btn btn-outline-success mt-3">{{__($switchButton)}}</button>
                  </form>
                  @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection