@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">購入品詳細画面</div>

                <div class="card-body">
                  <div class="text-center">
                    <div class="pl-2 text-center mb-4">
                        <img src="/{{ $product->image }}" width="200" height="200">
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
                      {{ $purchase->amount }}個
                    </div>
                    
                    <div class="pl-2">
                      <span id="total_price">小計 : </span>
                      {{$product->price * $purchase->amount}} 円
                    </div>
                    <div class="pl-2">
                      <span id="category_id">カテゴリー : </span>
                      {{ $category }}
                    </div>
                    <div class="pl-2">
                        <span id="status_id">ステータス：</span>
                        {{ $status->delivery_status_name }}
                    </div>
                    
                    <div class="pl-2">
                      <span id="describe">詳細 : </span>
                      {{ $product->describe }}
                    </div>
                    
                  @if($purchase->delivery_status_id == 2)
                  <form method="POST" action="{{ route('completeTransaction') }}" class="text-center">
                  @csrf
                  
                  <p class='mt-4'>商品が届きましたら、取引完了ボタンを押してください。</p>
                    <input type="hidden" name="id" value={{ $purchase->id }}>
                    <button type="submit" class="btn btn-outline-primary btn-sm mt-2">取引完了</button>
                  </form>

                  @else
                  <form method="GET" action="/mypage/purchaseHistory" class="text-center">
                    @csrf
                      <button type="submit" class="btn btn-outline-dark btn-sm mt-2">戻る</button>
                    </form>
                  @endif

                  </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection