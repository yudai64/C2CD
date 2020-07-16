@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">確認画面</div>

                <div class="card-body mx-auto">
                  
                  <form method="POST" action="/register" >
                  @csrf
                    <div class="pl-2">
                      <span id="user_name">名前 : </span>
                      {{ $post_data['user_name'] }}
                    </div>
                    <div class="pl-2">
                      <span id="email">メールアドレス : </span>
                      {{ $post_data['email'] }}
                    </div>
                    <div class="pl-2">
                      <span id="postal_code">郵便番号 : </span>
                      {{ $post_data['postal_code'] }}
                    </div>
                    <div class="pl-2">
                      <span id="address">アドレス : </span>
                      {{ $post_data['address'] }}
                    </div>
                    <div class="pl-2">
                      <span id="phone_number">電話番号 : </span>
                      {{ $post_data['phone_number'] }}
                    </div>
                    <div class="text-center">
                    <input type="hidden" name="email" value="{{ $post_data['email'] }}" />
                    <input type="hidden" name="password" value="{{ $post_data['password'] }}" />
                    <input type="hidden" name="password_confirmation" value="{{ $post_data['password_confirmation'] }}" />
                    <input type="hidden" name="user_name" value="{{ $post_data['user_name'] }}" />
                    <input type="hidden" name="postal_code" value="{{ $post_data['postal_code'] }}" />
                    <input type="hidden" name="address" value="{{ $post_data['address'] }}" />
                    <input type="hidden" name="phone_number" value="{{ $post_data['phone_number'] }}" />

                    <button type="submit" class="btn btn-primary ml-2 mt-3">{{ __('登録') }}</button>
                    <button type="button" class='btn btn-outline-dark ml-2 mt-3' onclick="history.back()">戻る</button>
                  </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
