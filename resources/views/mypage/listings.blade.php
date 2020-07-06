@extends('layouts.app')

@section('content')
<div class="container ">
  <div class="row  justify-content-center">
  <div class="col-md-8">
<div class="card">
  <div class="card-header">出品履歴一覧</div>
  
  <div class="card-body">
  @foreach($products as $product)
  <div class="row  justify-content-center">
      <div class="card mt-3" style="width:30rem;" >
        
          
         <div class="row  justify-content-center">
          <div class="col-lg-4">
            <a href="http://127.0.0.1:8000/mypage/listing/{{ $product->id}}">
              <img src="http://127.0.0.1:8000/{{ $product->image}}" width="80" height="80" class="card-img h-100" alt="...">
              </a>
          </div>
          <div class="col-lg-8 pl-2">
            <div class="card-body">
              <h4 class="card-title">{{ $product->product_name}}</h4>
              <p class="card-text"> {{ $product->price}}円</br>
                          {{ $product->status_name}}</p>
              
            </div>
          </div>
        </div>
      </div>
  </div>

      @endforeach
  </div>
  </div>
</div>

   </div>
</div>
   <div class="mx-auto mt-4" style="width: 200px;">{{ $products->links() }}</div>
</div>
@endsection