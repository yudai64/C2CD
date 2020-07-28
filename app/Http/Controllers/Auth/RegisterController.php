<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *a
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'user_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'postal_code' => ['required'],
            'address' => ['required'],
            'phone_number' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'user_name' => $data['user_name'],
            'email' => $data['email'],
            'postal_code' => $data['postal_code'],
            'address' => $data['address'],
            'phone_number' => $data['phone_number'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register2(Request $request)
    {
        $request->validate([
            'email'      => 'email|unique:users,email',
            'password' => 'min:8',
            'password_confirmation' => 'same:password',
        ]);

        $post_data = $request->all();
        $request->session()->put('post_data', $post_data);
        return view('auth.register2', compact('post_data'));
    }

    public function confirm(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'postal_code' => 'regex:/^\d{3}-\d{4}$/',
            'phone_number' => 'regex:/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/'
        ]);

        if ($validator->fails()) {
            return redirect('/register2')
                        ->withErrors($validator)
                        ->withInput();
        }

        if (is_null($request->email)) {
            $message = 'メールアドレスが確認できませんでした。始めから入力してください';
            return redirect('register')->with('message', $message);
        }

        $post_data = $request->all();
        return view('auth.confirm', compact('post_data'));
    }

}
