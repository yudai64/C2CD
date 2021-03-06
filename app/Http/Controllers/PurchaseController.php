<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Validator;
use App\Product;

class PurchaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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

    public function decrease(Request $request)
    {
        if($request->amount == 0) {
            DB::table('carts')->where('id', '=', $request->id)->delete();
        } else {
            DB::table('carts')->where('id', '=', $request->id)->update(['amount' => $request->amount]);
        }

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
        // $token = $request->_token;
        // if(is_null($token)) {
        //     return redirect('shoppingcart');
        // }
        $request->validate([
            'destination_name' => 'string', 'max:255',
            'destination_postal_code' => 'regex:/^\d{3}-\d{4}$/',
            'phone_number' => 'regex:/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/',
            'delivery_date' => 'date|after:today'
        ]);
        
        return view('/purchase/inputSettlementInfo', [
            'destination_name' => $request->destination_name,
            'destination_postal_code' => $request->destination_postal_code,
            'destination_address' => $request->destination_address,
            'phone_number' => $request->phone_number,
            'delivery_date' => $request->delivery_date
        ]);
    }

    public function confirm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'card_number'      => 'required|digits:16',
            'security_code' => 'required|digits:3',
            'expiration' => 'after_or_equal:last month'
        ]);

        if ($validator->fails()) {
            return redirect(route('input-settlement-info'))
                        ->withErrors($validator)
                        ->withInput();
        }

        if (is_null($request->delivery_date)) {
            $message = '送付先情報が確認できませんでした。';
            return redirect('shoppingcart')->with('message', $message);
        }

        $user = Auth::user();

        $products = DB::table('carts')->where('carts.user_id', $user->id)->join('products','carts.product_id', '=', 'products.id')->orderByRaw('carts.updated_at DESC')->select('carts.id as cart_id', 'products.id as id','products.product_name', 'products.image', 'products.price', 'carts.amount', 'carts.updated_at')->get();
        $total_price = 0;
        foreach($products as $product) {
            $total_price += $product->price * $product->amount;
        }

        return view('purchase/confirm', [
            'post_data' => $request->only('destination_name', 'destination_postal_code', 'destination_address', 'phone_number', 'delivery_date'),
            'products' => $products,
            'total_price' => $total_price
        ]);
    }

    public function determine(Request $request)
    {

        $user_id = Auth::id();
        $carts = DB::table('carts')->where('carts.user_id', '=', $user_id)->get();

        //カート情報が空、または送付先情報が空のときカート画面にリダイレクト
        if(count($carts) == 0 or is_null($request->destination_name)) {
            $message = '購入に失敗しました。もう一度やり直してください';
            return redirect('shoppingcart')->with('message', $message);
        }
        
        foreach($carts as $cart) {
            $product = Product::find($cart->product_id);
            //カートに入っている個数が在庫数より多いときカートの画面にリダイレクト
            if($cart->amount > $product->amount) {
                if($product->amount == 0) {
                    $message = $product->product_name . 'は在庫がありません。';
                } else {
                    $message = $product->product_name . 'の在庫数は' . $product->amount . '個です。購入数を減らしてから再度購入手続きに進んでください';
                }
                return redirect('shoppingcart')->with('message', $message);
            }
            //ユーザーがその商品を購入したことがあったら商品の購入者数を+1
            $sum = DB::table('purchase_histories')
            ->where('purchase_histories.product_id','=',$cart->product_id)
            ->where('purchase_histories.user_id','=',$user_id)->first();

            if(is_null($sum)){
                $product->purchasers_number += 1;
            }

            //購入履歴に反映
            DB::table('purchase_histories')->insert(
                ['user_id' => $user_id, 'product_id' => $cart->product_id, 'amount' => $cart->amount, 
                'destination_name' => $request->destination_name, 'destination_postal_code' => $request->destination_postal_code, 'destination_address' => $request->destination_address, 'phone_number' => $request->phone_number, 'delivery_date' => $request->delivery_date, 'delivery_status_id' => 1]
            );

            //商品テーブルの在庫とステータスを変更
            $product->amount -= $cart->amount;
            if($product->amount == 0) {
                $product->status_id = 3;
            }
            $product->save();
        }

        //カート情報削除
        DB::table('carts')->where('user_id', '=', $user_id)->delete();

        return view('/purchase/complete');
    }
}
