@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">プロフィール</div>

                <div class="card-body">
                  <div class="pl-2">
                    <span id="user_name">名前 : </span>
                    {{ $profile->user_name }}
                  </div>
                  <div class="pl-2">
                    <span id="email">メールアドレス : </span>
                    {{ $profile->email }}
                  </div>
                  <div class="pl-2">
                    <span id="postal_code">郵便番号 : </span>
                    {{ $profile->postal_code }}
                  </div>
                  <div class="pl-2">
                    <span id="address">アドレス : </span>
                    {{ $profile->address }}
                  </div>
                  <div class="pl-2">
                    <span id="phone_number">電話番号 : </span>
                    {{ $profile->phone_number }}
                  </div>
                </div>

                <a href="/mypage/profile/edit" class="ml-4">編集</a>
                <form method="GET" action="/mypage/profile/edit">
                  <button type="submit" class="btn btn-primary ml-4 mb-3">
                      {{ __('編集') }}
                  </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
