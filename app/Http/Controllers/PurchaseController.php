<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function cart()
    {
        $user = Auth::user();

        $products = DB::table('carts')->where('carts.user_id', $user->id)->join('products','carts.products_id', '=', 'products.id')->orderByRaw('carts.updated_at DESC')->select('products.id', 'products.product_name', 'products.image', 'products.price', 'carts.amount', 'carts.updated_at')->get();
        $total_price = 0;
        foreach($products as $product) {
            $total_price += $product->price * $product->amount;
        }

        return view('purchase.cart', [
            'products' => $products,
            'total_price' => $total_price
        ]);
    }
}
