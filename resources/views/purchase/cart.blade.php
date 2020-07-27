@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          @if (session('message'))
            <div class="alert alert-danger text-center">
                {{ session('message') }}
            </div>
          @endif
            <div class="card">
                <div class="card-header">ショッピングカート</div>

                <div class="card-body text-center">
                @if(count($products) === 0)
                <p class="mx-auto">現在、カートに商品は入っていません</p>
                @else
                  <div class="">
                    @foreach($products as $product)
                    <div class="mt-3 border w-75 mx-auto">
                      <div class="float-left">
                        <a href="/product/{{ $product->id}}">
                          <img src="/{{ $product->image}}" width="200" height="200">
                        </a>
                      </div>

                      <div class="clearfix">
                        <p class="text-center mt-4">{{ $product->product_name }}</p>
                        <p class="text-center">{{ $product->price }}円 × {{ $product->amount }}個</p>

                        <form class="text-center" method="post" action="{{ route('purchase.decrease')}}">
                          @csrf
                          <select name="amount">
                            @for($i=0; $i<=$product->amount; $i++)
                            <option value="{{ $i }}" @if($i == $product->amount) selected @endif>{{ $i }}</option>
                            @endfor
                          </select>
                          <input type="hidden" name="id" value="{{ $product->cart_id }}"/>
                          <button type="submit" class="btn btn-outline-dark btn-sm">{{ __('個数を変更') }}</button>
                        </form>

                        <form class="text-center mt-3" method="post" action="{{ route('purchase.delete')}}">
                          @csrf
                          <input type="hidden" name="id" value="{{ $product->cart_id }}"/>
                          <button type="submit" class="btn btn-outline-danger btn-sm">{{ __('削除') }}</button>
                        </form>
                      </div>

                    </div>
                    @endforeach

                    @if($total_price)
                      <p class="text-center mt-5">合計金額: {{ $total_price }}円</p>
                    @endif
                    <form class="text-center mt-3" method="GET" action="{{ route('input-send-info')}}">
                      <button type="submit" class="btn btn-primary">{{__('購入手続きへ進む')}}</button>
                    </form>
                  </div>
                @endif
                <form class="mt-4" method="GET" action="{{ route('home') }}">
                  <button type="submit" class="btn btn btn-outline-dark">
                  @if(count($products) === 0)
                  {{__('トップへ戻る')}}
                  @else
                  {{__('購入を続ける')}}
                  @endif
                  </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
