@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('決済情報画面') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('input-settlement-info') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="card_number" class="col-md-4 col-form-label text-md-right">{{ __('カード番号') }}</label>

                            <div class="col-md-6">
                                <input id="card_number" type="text" class="form-control @error('card_number') is-invalid @enderror" name="card_number" value="" required autocomplete="card_number">

                                @error('card_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="expiration_date" class="col-md-4 col-form-label text-md-right">{{ __('有効期限') }}</label>

                            <div class="col-md-6">
                                <input id="expiration_date" type="expiration_date" class="form-control @error('expiration_date') is-invalid @enderror" name="expiration_date" value="" required autocomplete="expiration_date">

                                @error('expiration_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="security_code" class="col-md-4 col-form-label text-md-right">{{ __('セキュリティーコード') }}</label>

                            <div class="col-md-6">
                                <input id="security_code" type="text" class="form-control @error('security_code') is-invalid @enderror" name="security_code" value="" required autocomplete="security_code" placeholder="">

                                @error('security_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mt-4">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('購入を確定する') }}
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
