<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'textarea',
        'category_id',
    ];

    public static $rules = array(
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'gender' => 'required|integer|in:1,2,3',
        'email' => 'required|string|email|max:255',
        'tel' => 'required|string|max:15',
        'address' => 'required|string|max:255',
        'building' => 'nullable|string|max:255',
        'textarea' => 'required|string',
        'category_id' => 'required|integer',
        'created_at' => 'date',
        'updated_at' => 'date',
    );
    public function getDetail()
    {
        return implode(' ',[
            'ID:' . $this->id,
            $this->first_name,
            $this->last_name,
            $this->gender_text,
            $this->email,
            $this->tel,
            $this->address,
            $this->building,
            $this->textarea,
            $this->category_id_text,
            $this->created_at,
            $this->updated_at,
        ]);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getGenderTextAttribute()
    {
        $genders = [1 => '男性', 2 => '女性', 3 => 'その他'];
        return $genders[$this->gender] ?? '不明';
    }

    public function getCategoryIdTextAttribute()
    {
        $categoryNames = [1 => '商品のお届けについて', 2 => '商品の交換について', 3 => '商品トラブル', 4 => 'ショップへのお問い合わせ', 5 => 'その他'];
        return $categoryNames[$this->category_id] ?? '不明';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}