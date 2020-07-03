@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">商品詳細画面</div>

                <div class="card-body">
                  <form method="POST" action="{{ route('purchase.add') }}">
                  @csrf
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
                      {{ $product->category_id }}
                    </div>
                    <div class="pl-2">
                      <span id="describe">詳細 : </span>
                      {{ $product->describe }}
                    </div>
                    <input type="hidden" name="id" value="{{ $product->id }}"/>

                    @if(Auth::id() !== $product->user_id)
                      <label class="mt-5 ml-2">数量: <input type="number" name="amount" max="{{ $product->amount }}" min="0" class=""></label></br>
                      <button type="submit" class="btn btn-primary ml-2 mt-3">{{ __('カートに入れる') }}</button>
                    @endif
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
