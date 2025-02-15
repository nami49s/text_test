<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;


class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login'); // login.blade.php を表示
    }
    
    public function login(LoginRequest $request): RedirectResponse
    {
        // フォームリクエストでバリデーション済みなので、$request のデータは安全
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('admin.index')->with('success', 'ログイン成功！');
        }

        return back()->withErrors(['email' => 'メールアドレスまたはパスワードが間違っています。']);
    }
}