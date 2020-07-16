@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('出品完了') }}</div>
                <div class="text-center">
                <div class="card-body">
                    
                    thank you
                   
                </div>
                <a href="http://127.0.0.1:8000/product/{{ $id}}" class="ml-3">出品詳細ページに行く</a>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
