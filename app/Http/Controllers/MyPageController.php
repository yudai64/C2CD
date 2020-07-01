<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    {$user = Auth::user();
        

        $products = DB::table('products')->where('user_id', $user->id)->join('statuses','status_id','statuses.id')->paginate(20);

        return view('mypage/listings', [
            'products' => $products
        ]);
    }
}
