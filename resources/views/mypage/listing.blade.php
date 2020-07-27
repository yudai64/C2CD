@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">商品詳細画面</div>

                <div class="card-body text-center">
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
                      <span id="amount">在庫数 : </span>
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

                  @if(count($buyer_infos) > 0)
                  <div class="pt-5">
                    <h4>お知らせ</h4>
                    <p>商品が購入されたので以下の宛先に発送をしてください。</br>発送が完了しましたら、発送完了ボタンを押してください。</p>
                    @foreach($buyer_infos as $info)
                    <div class="mb-4">
                      <div class="pl-2">
                        <span id="user_name">宛名 : </span>
                        {{ $info->destination_name }}
                      </div>
                      <div class="pl-2">
                        <span id="destination_postal_code">郵便番号 : </span>
                        {{ $info->destination_postal_code }}
                      </div>
                      <div class="pl-2">
                        <span id="destination_address">住所 : </span>
                        {{ $info->destination_address }}
                      </div>
                      <div class="pl-2">
                        <span id="phone_number">電話番号 : </span>
                        {{ $info->phone_number }}
                      </div>
                      <div class="pl-2">
                        <span id="delivery_date">お届け予定日 : </span>
                        {{ $info->delivery_date }}
                      </div>
                      <div class="pl-2">
                        <span id="amount">個数 : </span>
                        {{ $info->amount }}個
                      </div>
                      <form method="POST" action="{{ route('noticeDelivery')}}">
                      @csrf
                        <input type="hidden" name="purchase_history_id" value="{{$info->id}}"/>
                        <input type="hidden" name="product_id" value="{{$product->id}}"/>
                        <button class="btn btn-outline-primary btn-sm mt-2">{{__('発送完了')}}</button>
                      </form>
                    </div>
                    @endforeach
                    </div>
                  @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection