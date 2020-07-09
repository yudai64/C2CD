@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('決済情報画面') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('purchase.confirm') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="card_number" class="col-md-4 col-form-label text-md-right">{{ __('カード番号') }}</label>

                            <div class="col-md-6">
                                <input id="card_number" type="text" class="form-control @error('card_number') is-invalid @enderror" name="card_number" value="{{old('card_number')}}" required autocomplete="card_number" placeholder="16桁の半角数字でご記入ください">

                                @error('card_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="expiration_month" class="col-md-4 col-form-label text-md-right">{{ __('有効期限') }}</label>

                            <div class="col-md-6">
                                <select style="width: 70px" id="expiration_month" class="float-left form-control @error('expiration_month') is-invalid @enderror" name="expiration_month" value=""  required autocomplete="expiration_month">
                                    <option value="">月</option>
                                    @for($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" @if(old('expiration_month') == $i) selected @endif>{{ $i }}</option>
                                    @endfor
                                </select>

                                <select style="width: 100px" id="expiration_year" class="clearfix form-control @error('expiration_year') is-invalid @enderror" name="expiration_year" value=""  required autocomplete="expiration_year">
                                    <option value="">年</option>
                                    @for($i = 2020; $i <= 2040; $i++)
                                    <option value="{{ $i }}" @if(old('expiration_year') == $i) selected @endif>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="security_code" class="col-md-4 col-form-label text-md-right">{{ __('セキュリティーコード') }}</label>

                            <div class="col-md-5">
                                <input id="security_code" type="text" class="form-control @error('security_code') is-invalid @enderror" name="security_code" value="" required autocomplete="security_code" placeholder="3桁の半角数字でご記入ください">

                                @error('security_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <input type="hidden" name="destination_name"          value= @if(isset($destination_name))          "{{ $destination_name }}"          @else "{{old('destination_name')}}" @endif/>
                        <input type="hidden" name="destination_postal_code" value= @if(isset($destination_postal_code)) "{{ $destination_postal_code }}" @else "{{old('destination_postal_code')}}" @endif/>
                        <input type="hidden" name="destination_address"       value= @if(isset($destination_address))       "{{ $destination_address }}"       @else "{{old('destination_address')}}" @endif/>
                        <input type="hidden" name="phone_number"         value= @if(isset($phone_number))          "{{ $phone_number }}"         @else "{{old('phone_number')}}" @endif/>
                        <input type="hidden" name="delivery_date"            value= @if(isset($delivery_date))            "{{ $delivery_date }}"            @else "{{old('delivery_date')}}" @endif/>

                        <div class="form-group row mt-4">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('購入情報を確認') }}
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
