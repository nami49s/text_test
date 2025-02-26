<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CreateRequest;
use Response;


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
    // CSVエクスポート機能
    public function export(Request $request)
    {
            // 検索条件を取得
        $query = $request->input('query');
        $gender = $request->input('gender');
        $category_id = $request->input('category_id');
        $date = $request->input('date');

        // クエリの絞り込み
        $contacts = Contact::query();

        if ($query) {
            $contacts->where(function($q) use ($query) {
                $q->where('first_name', 'like', "%{$query}%")
                ->orWhere('last_name', 'like', "%{$query}%")
                ->orWhere('email', 'like', "%{$query}%");
            });
        }

        if ($gender && $gender !== 'all') {
            $contacts->where('gender', $gender);
        }

        if ($category_id) {
            $contacts->where('category_id', $category_id);
        }

        if ($date) {
            $contacts->whereDate('created_at', $date);
        }

        // 絞り込んだ結果を取得
        $contacts = $contacts->get();

        // ヘッダー
        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=contacts.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        // 出力ストリームを開く
        $handle = fopen('php://output', 'w');

        // CSVのヘッダー行
        fputcsv($handle, ['お名前（姓）', 'お名前（名）', '性別', 'メールアドレス', '電話番号', '住所', '建物名', 'お問い合わせの種類', 'お問い合わせ内容']);

        // 各行のデータ
        foreach ($contacts as $contact) {
            fputcsv($handle, [
                $contact->first_name,
                $contact->last_name,
                $contact->gender_text,
                $contact->email,
                $contact->tel,
                $contact->address,
                $contact->building,
                $contact->category_id_text,
                $contact->textarea,
            ]);
        }

        // 出力ストリームを閉じる
        fclose($handle);

        // レスポンスを返す
        return Response::make('', 200, $headers);
    }
}