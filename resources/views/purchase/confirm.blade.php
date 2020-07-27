@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">購入情報確認画面</div>
                  <div class="card-body">
                  <div class="text-center">
                    <h5>お届け先情報</h5>
                    <div class="pl-2">
                      <span id="destination_name">お名前 : </span>
                      {{ $post_data['destination_name'] }}
                    </div>
                    <div class="pl-2">
                      <span id="destination_postal_code">便番号 : </span>
                      {{ $post_data['destination_postal_code'] }}
                    </div>
                    <div class="pl-2">
                      <span id="destination_address">住所 : </span>
                      {{ $post_data['destination_address'] }}
                    </div>
                    <div class="pl-2">
                      <span id="phone_number">電話番号 : </span>
                      {{ $post_data['phone_number'] }}
                    </div>
                    <div class="pl-2">
                      <span id="delivery_date">お届け希望日 : </span>
                      {{ $post_data['delivery_date'] }}
                    </div>
                  </div>
                  <div class="pt-4">
                    <h5 class="pt-2 pb-1 text-center">購入商品</h5>
                      @foreach($products as $product)
                      <div class="mt-3 border w-75 mx-auto">
                        <div class="float-left">
                          <a href="/product/{{ $product->id}}">
                            <img src="/{{ $product->image}}" width="200" height="200">
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
                    
                    <form class="text-center mt-3" method="POST" action="{{ route('purchase.determine')}}">
                    @csrf
                      <input type="hidden" name="destination_name"          value="{{$post_data['destination_name']}}"/>
                      <input type="hidden" name="destination_postal_code" value="{{$post_data['destination_postal_code']}}"/>
                      <input type="hidden" name="destination_address"       value="{{$post_data['destination_address']}}"/>
                      <input type="hidden" name="phone_number"              value="{{$post_data['phone_number']}}"/>
                      <input type="hidden" name="delivery_date"                 value="{{$post_data['delivery_date']}}"/>
                      <button type="submit" class="btn btn-primary ml-2 mt-3">{{__('購入を確定する')}}</button>
                      <button type="button" class='btn btn-outline-dark ml-2 mt-3' onclick="history.back()">戻る</button>
                    </form>
                  </div>
            </div>
        </div>
    </div>
</div>
@endsection
