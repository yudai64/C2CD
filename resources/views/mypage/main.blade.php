@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">マイページ</div>

                <div class="card-body text-center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="links float-left text-left">
                        <a href="/mypage/purchaseHistory">購入履歴@if($purchase_count > 0) ({{ $purchase_count }})@endif</a><br>
                        <a href="{{ route('mypage.listings') }}">出品履歴@if($listing_count > 0) ({{ $listing_count }})@endif</a><br>
                        <a href="/mypage/profile">プロフィール</a>
                    </div>
                    <div class="card w-75 clearfix mx-auto">
                        <div class="card-header">お知らせ@if($count > 0) ({{ $count }})@endif</div>
                        <div class="card-body text-center">
                        @if($count > 0)
                        @foreach($purchase_products as $purchase_product)
                                <div class="mb-3 border">
                                <a href="{{ route('purchase.show', ['id' => $purchase_product->purchase_histories_id])}}">{{ $purchase_product->product_name}}</a>が発送されました。</br>
                                商品が届きましたら取引完了してください。</div>
                            @endforeach
                            @foreach($listing_products as $listing_product)
                                <div class="mb-3 border">
                                <a href="{{ route('listing.show', ['id' => $listing_product->product_id])}}">{{ $listing_product->product_name}}</a>が購入されました。</br>
                                商品を発送してください。</div>
                            @endforeach
                        @else
                            現在取引中の商品はありません。
                        @endif
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
