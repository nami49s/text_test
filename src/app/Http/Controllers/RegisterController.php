<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;  // Hashクラスのインポート
use App\Models\User;  // Userモデルのインポート


class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $validated = $request->all();

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('login')->with('success', '登録完了しました！');
    }
    public function create()
    {
        return view('register');
    }

}
