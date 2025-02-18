<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'ログインしてください');
        }

        $contacts = Contact::paginate(10);
        $categories = Category::all();

        // ビューにデータを渡して表示
        return view('admin', compact('contacts','categories'));
        }

    public function search(Request $request)
    {
        // 検索条件を取得
        $query = $request->input('query');
        $gender = $request->input('gender');
        $category_id = $request->input('category_id');
        $date = $request->input('date');

        // クエリをビルド
        $contacts = Contact::query();

        if ($query) {
            $contacts->where('first_name', 'like', '%' . $query . '%')
                    ->orWhere('last_name', 'like', '%' . $query . '%')
                    ->orWhere('email', 'like', '%' . $query . '%');
        }

        if (!empty($gender) && $gender !== 'all') {
            $contacts->where('gender', $gender);
        }

        if (!empty($category_id)) {
            $contacts->where('category_id', $category_id);
        }

        if ($date) {
            $contacts->whereDate('created_at', $date);
        }

        // 検索結果を取得し、ページネーション
        $contacts = $contacts->paginate(7); // ページネーションの件数は必要に応じて調整
        $categories = Category::all();

        // 結果をビューに渡して表示
        return view('admin', compact('contacts', 'categories'));
        }
       
        public function destroy($contactId)
        {
        $contact = Contact::findOrFail($contactId);
        $contact->delete();

        return redirect()->route('admin.index')->with('success', 'お問い合わせを削除しました');
        }

}