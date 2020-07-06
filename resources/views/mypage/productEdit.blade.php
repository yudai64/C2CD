@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('出品情報変更') }}</div>

                <div class="card-body">
                    <form method="POST" action="/mypage/listing/productUpdate" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="pl-2 text-center mb-4">
                            <img src="http://127.0.0.1:8000/{{ $product->image }}" width="200" height="200">
                        </div>
                        <div class="form-group row">
                            <label for="product_name" class="col-md-4 col-form-label text-md-right">{{ __('商品名') }}</label>

                            <div class="col-md-6">
                                <input id="product_name" type="product_name" class="form-control @error('product_name') is-invalid @enderror" name="product_name" value="{{ $product->product_name }}" required autocomplete="product_name">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('価格') }}</label>

                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $product->price }}" required autocomplete="price">
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('個数') }}</label>

                            <div class="col-md-6">
                                <input id="amount" type="text" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ $product->amount }}" required autocomplete="amount">
                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="category_id" class="col-md-4 col-form-label text-md-right">{{ __('カテゴリー') }}</label>

                            <div class="col-md-6">
                                <select id="category_id" class="form-control @error('category_id') is-invalid @enderror" name="category_id" value="{{ $product->category_id }}"  required autocomplete="category_id">
                                    <option value="">選択してください</option>
                                    <option value="1" @if(old('category_id') == 1) selected @endif>カテゴリー1</option>
                                    <option value="2" @if(old('category_id') == 2) selected @endif>カテゴリー2</option>
                                    <option value="3" @if(old('category_id') == 3) selected @endif>カテゴリー3</option>
                                </select>

                                @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="status_id" class="col-md-4 col-form-label text-md-right">{{ __('状態') }}</label>

                            <div class="col-md-6">
                                <select id="status_id" class="form-control @error('status_id') is-invalid @enderror" name="status_id" value="{{ $product->status_id }}"  required autocomplete="status_id">
                                    <option value="">選択してください</option>
                                    <option value="1" @if(old('status_id') == 1) selected @endif>出品中</option>
                                    <option value="2" @if(old('status_id') == 2) selected @endif>停止中</option>
                                </select>

                                @error('status_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       

                        <div class="form-group row">
                            <label for="describe" class="col-md-4 col-form-label text-md-right">{{ __('商品詳細') }}</label>

                            <div class="col-md-6">
                                <input id="describe" type="describe" class="form-control @error('describe') is-invalid @enderror" name="describe" value="{{ $product->describe }}" required autocomplete="new-describe">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('画像') }}</label>

                            <div class="col-md-6">
                                <input id="image" type="file" class="@error('image') is-invalid @enderror" value="{{ old('image') }}" name="image">

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <input type="hidden" name="id" value="{{ $product->id }}"/>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('変更') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
