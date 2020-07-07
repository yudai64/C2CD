<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

use App\User;

use App\Product;

class MyPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getUser()
    {
        return view('/mypage/main');
    }

    public function profile()
    {
        $user_id = Auth::id();
        return view('/mypage/profile', [
            'profile' => User::find($user_id)
        ]);
    }

    public function edit()
    {
        $user_id = Auth::id();
        return view('/mypage/profileEdit', [
            'profile' => User::find($user_id)
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'email'      => 'required|email|unique:users,email,'.Auth::user()->email.',email',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
            ]);
        
        $user_id = Auth::id();
        $user = User::find($user_id);
        $user->email = $request->email;
        $user->postal_code = $request->postal_code;
        $user->address = $request->address;
        $user->phone_number = $request->phone_number;
        $user->save();
        return redirect('/mypage/profile');
    }

    public function listings()
    {
        $user = Auth::user();
        
        $products = DB::table('products')->where('products.user_id', $user->id)->join('statuses','products.status_id', '=', 'statuses.id')->orderByRaw('products.updated_at DESC')->select('products.id', 'products.product_name', 'products.image', 'products.price', 'products.amount', 'products.describe', 'products.user_id', 'products.category_id', 'products.status_id', 'statuses.status_name')->paginate(20);

        return view('mypage/listings', [
            'products' => $products
        ]);
    }

    
    public function listing($id)
    {
        $product = DB::table('products')->where('products.id',$id)->first();
        $category = DB::table('categories')->where('id', "=", $product->category_id)->value('category_name');

        //出品中or停止中の商品のみ編集可能
        if($product->status_id == 1 || $product->status_id == 2){
        $url = "/mypage/listing/{$product->id}/edit";
        $button = "編集する";
        }else{
            $url = "/mypage/listings";
            $button = "戻る";
        }

        switch($product->status_id) {
            case 1:
                $switchButton = '出品停止';
            break;
            case 2:
                $switchButton = '出品再開';
            break;
            default:
                $switchButton = '表示なし';
        }

        return view('mypage/listing', [
            'product' => $product,
            'url'=> $url,
            'category' => $category,
            'button' => $button,
            'switchButton' => $switchButton,
        ]);
    }
    public function editProduct($id)
    {
        $product = DB::table('products')->where('products.id',$id)->first();
        
        return view('mypage/productEdit',[
        'product' => $product,
        ]);
    }

    public function productUpdate(ProductRequest $request)
    {
        $product = Product::find($request->id);
        $product->product_name = $request->product_name;
        $product->price = $request->price;
        $product->amount = $request->amount;
        $product->category_id = $request->category_id;
        $product->describe = $request->describe;

        $image = $request->file('image');
        if(is_null($image)){
            $product->image = $product->image;
        } else {
            $path = $image->store('public/product');
            $read_path = str_replace('public/', 'storage/', $path);
            $product->image = $read_path;
        }

        $product->save();
        return redirect('/mypage/listings');

    }

    public function switch(Request $request)
    {
        $product = Product::find($request->id);

        if($product->status_id ==1){
            $product->status_id = 2;
        } else if($product->status_id == 2) {
            $product->status_id = 1;
        } else {
            $product->status_id = $product->status_id;
        }

        $product->save();
        return redirect('/mypage/listings');
    }
}
