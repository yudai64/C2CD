@extends('layouts.app')

@section('content')
<div class="container text-center">
@isset($category)
    カテゴリー: {{ $category }}での検索結果
@endisset
<div class="row mx-auto mt-3">
            @if(count($products) === 0)
                <p class="mx-auto">このカテゴリーの商品は見つかりませんでした。</p>
            @else
                @foreach($products as $product)
                <div class="col-md-3 mt-5 text-center">
                        <a href="http://127.0.0.1:8000/product/{{ $product->id}}">
                        <img src="http://127.0.0.1:8000/{{ $product->image }}" width="250" height="250">
                        </a>
                        <div class="mt-2 mx-auto">
                            {{ $product->product_name}}</br>
                            {{ $product->price}}円
                        </div>
                </div>
                @endforeach
            @endif
</div>
<div class="mx-auto mt-4" style="width: 200px;">{{ $products->appends(request()->input())->links() }}</div>
</div>
@endsection
