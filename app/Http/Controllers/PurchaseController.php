<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;

class PurchaseController extends Controller
{
    public function cart()
    {
        $user = Auth::user();

        $products = DB::table('carts')->where('carts.user_id', $user->id)->join('products','carts.product_id', '=', 'products.id')->orderByRaw('carts.updated_at DESC')->select('carts.id as cart_id', 'products.id as id','products.product_name', 'products.image', 'products.price', 'carts.amount', 'carts.updated_at')->get();
        $total_price = 0;
        foreach($products as $product) {
            $total_price += $product->price * $product->amount;
        }

        return view('purchase.cart', [
            'products' => $products,
            'total_price' => $total_price
        ]);
    }

    public function add(Request $request)
    {
        $record = DB::table('carts')->where('product_id', $request->id)->where('user_id', Auth::id())->first();
        if($record == null) {
            DB::table('carts')->insert(
                ['user_id' => Auth::id(), 'product_id' => $request->id, 'amount' => $request->amount]
            );
        } else {
            DB::table('carts')->where('id', '=', $record->id)->delete();
            DB::table('carts')->insert(
                ['user_id' => Auth::id(), 'product_id' => $request->id, 'amount' => $request->amount + $record->amount]
            );
        }

        return redirect('shoppingcart');
    }

    public function delete(Request $request)
    {
        DB::table('carts')->where('id', '=', $request->id)->delete();
        return redirect('shoppingcart');
    }

    public function inputSendInfo()
    {
        $user_id = Auth::id();
        $carts = DB::table('carts')->where('user_id', '=', $user_id)->get();
        if(count($carts) == 0) {
            return redirect('shoppingcart');
        }
        return view('/purchase/inputSendInfo', [
            'profile' => User::find($user_id)
        ]);
    }

    public function inputSettlementInfo(Request $request)
    {
        //直アクセスのとき(改善の余地あり)
        $token = $request->_token;
        if(is_null($token)) {
            return redirect('shoppingcart');
        }

        $post_data = $request->all();
        return view('/purchase/inputSettlementInfo');
    }

    public function determine()
    {
        return view('/purchase/complete');
    }
}
