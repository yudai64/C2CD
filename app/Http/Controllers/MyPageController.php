<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\User;

class MyPageController extends Controller
{

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
}
