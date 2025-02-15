<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CreateRequest;

class ContactController extends Controller
{
    public function create()
    {
        // 必要なカテゴリを取得（フォームで選択するため）
        $categories = Category::all();
        
        // create ビューを返す
        return view('contact.contacts', compact('categories'));
    }
    
    // 確認画面
    public function confirm(CreateRequest $request)
    {
        // バリデーション済みデータを取得
        $data = $request->validated();

        $category = Category::find($data['category_id']);
        $data['category_name'] = $category ? $category->name : '不明';

        // 確認画面のビューを表示
        return view('contact.confirm', compact('data'));
    }
    
    public function store(CreateRequest $request)
    {
        // バリデーション済みデータの取得
        $validatedData = $request->validate(Contact::$rules);
        // データを保存
        Contact::create($validatedData);

        // 完了ページへリダイレクト
        return redirect()->route('contact.thanks');
    }

    public function thanks()
    {
        return view('contact.thanks');
    }
}