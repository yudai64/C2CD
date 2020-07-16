@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('送付先画面') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('input-settlement-info') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="destination_name" class="col-md-4 col-form-label text-md-right">{{ __('名前') }}</label>

                            <div class="col-md-6">
                                <input id="destination_name" type="text" class="form-control @error('destination_name') is-invalid @enderror" name="destination_name" value="{{ $profile->user_name }}" required autocomplete="user_name">

                                @error('destination_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="destination_postal_code" class="col-md-4 col-form-label text-md-right">{{ __('郵便番号') }}</label>

                            <div class="col-md-6">
                                <input id="destination_postal_code" type="text" class="form-control @error('destination_postal_code') is-invalid @enderror" name="destination_postal_code" value="{{ $profile->postal_code }}" required autocomplete="destination_postal_code" placeholder="123-4567">

                                @error('destination_postal_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="destination_address" class="col-md-4 col-form-label text-md-right">{{ __('住所') }}</label>

                            <div class="col-md-6">
                                <input id="destination_address" type="text" class="form-control @error('destination_address') is-invalid @enderror" name="destination_address" value="{{ $profile->address }}" required autocomplete="destination_address">

                                @error('destination_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('電話番号') }}</label>

                            <div class="col-md-6">
                                <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ $profile->phone_number }}" required autocomplete="phone_number"  placeholder="012-3456-7890">

                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="delivery_date" class="col-md-4 col-form-label text-md-right">{{ __('お届け希望日') }}</label>

                            <div class="col-md-6">
                            <input id="delivery_date" type="date"  class="form-control @error('delivery_date') is-invalid @enderror" name="delivery_date" value="{{old('delivery_date')}}" required autocomplete="delivery_date">

                                @error('delivery_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mt-4">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary ml-2 mt-3">
                                    {{ __('決済情報画面に進む') }}
                                </button>
                                <button type="button" class='btn btn-outline-dark ml-2 mt-3' onclick="history.back()">戻る</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
