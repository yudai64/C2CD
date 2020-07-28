<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

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
        $image = $request->file('image');
        $path = Storage::disk('s3')->putFile('/', $image, 'public');
        $url = Storage::disk('s3')->url($path);
        $product_name = $request->product_name;
        $price = $request->price;
        $amount = $request->amount;
        $describe = $request->describe;
        $category_id = $request->category_id;
        $category = DB::table('categories')->where('id', '=', $category_id)->value('category_name');

        $post_data = array(
            'url' => $url,
            'product_name' => $product_name,
            'price' => $price,
            'amount' => $amount,
            'describe' => $describe,
            'category_id' => $category_id,
            'category' => $category,
        );
        
        $request->session()->put('post_data', $post_data);
        return view('product/confirm', compact('post_data'));
    }

    public function store(Request $request, Product $product)
    {
        $post_data = session()->get('post_data');
        $read_path = $post_data['url'];
        $request->session()->forget('post_data');

        $product->product_name = $post_data['product_name'];
        $product->price = (int)$post_data['price'];
        $product->amount = (int)$post_data['amount'];
        $product->user_id = Auth::id();
        $product->category_id = (int)$post_data['category_id'];
        $product->status_id = 1;
        $product->describe = $post_data['describe'];
        $product->image = $read_path;
        $product->purchasers_number = 0;
        $product->save();

        $id = $product->id;

        return view('product.complete', [
            'id' => $id
        ]);
    }

    public function show(Product $product)
    {
        $category_id = $product->category_id;
        $category = DB::table('categories')->where('id', '=', $category_id)->value('category_name');

        return view('product.show', [
            'product' => $product,
            'category' => $category
        ]);
    }
}
