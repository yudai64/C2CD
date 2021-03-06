@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">出品確認画面</div>

                <div class="card-body mx-auto">
                  <form method="POST" action="{{ route('product.store') }}" >
                  @csrf
                    <div class="pl-2  mb-4">
                        <img src="{{ $post_data['url'] }}" width="200" height="200">
                    </div>
                    <div class="pl-2">
                      <span id="product_name">商品名 : </span>
                      {{ $post_data['product_name'] }}
                    </div>
                    <div class="pl-2">
                      <span id="price">価格 : </span>
                      {{ $post_data['price'] }}円
                    </div>
                    <div class="pl-2">
                      <span id="amount">数量 : </span>
                      {{ $post_data['amount'] }}個
                    </div>
                    <div class="pl-2">
                      <span id="category">カテゴリー : </span>
                      {{ $post_data['category'] }}
                    </div>
                    <div class="pl-2">
                      <span id="describe">詳細 : </span>
                      {{ $post_data['describe'] }}
                    </div>
                    <div class="text-center">
                    <input type="hidden" name="product_name" value="{{ $post_data['product_name'] }}">
                    <input type="hidden" name="price" value="{{ $post_data['price'] }}">
                    <input type="hidden" name="amount" value="{{ $post_data['amount'] }}">
                    <input type="hidden" name="category_id" value="{{ $post_data['category_id'] }}">
                    <input type="hidden" name="describe" value="{{ $post_data['describe'] }}">
                    <input type="hidden" name="url" value="{{ $post_data['url'] }}">
                    <button type="submit" class="btn btn-primary ml-2 mt-3">{{ __('出品') }}</button>
                    <button type="button" class='btn btn-outline-dark ml-2 mt-3' onclick="history.back()">戻る</button>
                  </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
