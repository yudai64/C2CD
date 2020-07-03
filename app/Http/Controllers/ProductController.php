<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('product/create');
    }

    public function confirm(ProductRequest $request, Product $product)
    {
        // dd($request->file('image'));
        $image = $request->file('image');
        $temp_path = $image->store('public/temp');
        $read_temp_path = str_replace('public/', 'storage/', $temp_path);

        $product_name = $request->product_name;
        $price = $request->price;
        $amount = $request->amount;
        $describe = $request->describe;
        $category_id = $request->category_id;
        
        $post_data = array(
            'temp_path' => $temp_path,
            'read_temp_path' => $read_temp_path,
            'product_name' => $product_name,
            'price' => $price,
            'amount' => $amount,
            'describe' => $describe,
            'category_id' => $category_id
        );

        $request->session()->put('post_data', $post_data);

        return view('product/confirm', compact('post_data'));
    }

    public function store(Request $request, Product $product)
    {
        $post_data = session()->get('post_data');
        // var_dump($post_data);
        $temp_path = $post_data['temp_path'];
        $read_temp_path = $post_data['read_temp_path'];

        //ファイル名
        $filename = str_replace('public/temp/', '', $temp_path);
        //画像を保存するパス
        $storage_path = 'public/product/' . $filename;

        $request->session()->forget('post_data');

        //ファイルを移動
        Storage::move($temp_path, $storage_path);
        //画像を読み込むときのパス
        $read_path = str_replace('public/', 'storage/', $storage_path);

        $product->product_name = $post_data['product_name'];
        $product->price = (int)$post_data['price'];
        $product->amount = (int)$post_data['amount'];
        $product->user_id = Auth::id();
        $product->category_id = (int)$post_data['category_id'];
        $product->status_id = 1;
        $product->describe = $post_data['describe'];
        $product->image = $read_path;
        $product->save();

        $id = $product->id;

        return view('product.complete', [
            'id' => $id
        ]);
    }

    public function show(Product $product)
    {
        $user = Auth::user();
        return view('product.show', [
            'product' => $product,
        ]);
    }
}
