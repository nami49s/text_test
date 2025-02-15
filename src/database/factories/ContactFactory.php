<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
   * The name of the factory's corresponding model.
   *
   * @var string
   */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $phone = $this->faker->phoneNumber;
        if (strpos($phone, '-') !== false) {
        $phoneParts = explode('-', $phone); // ハイフンで分割
        } else {
        // ハイフンがない場合は、適当な分割方法を適用（例えば、番号の長さで分けるなど）
        $phoneParts = str_split($phone, 4); // 4桁ごとに分割
        }

        return [
            'category_id' => $this->faker->numberBetween(1, 5), // ランダムなカテゴリID
            'first_name' => $this->faker->firstName,             // ランダムな名前（名）
            'last_name' => $this->faker->lastName,               // ランダムな名前（姓）
            'gender' => $this->faker->randomElement([1, 2, 3]), // ランダムな性別
            'email' => $this->faker->unique()->safeEmail,        // ランダムでユニークなメールアドレス
            'tel1' => isset($phoneParts[0]) ? $phoneParts[0] : '', // 電話番号の最初の部分（例: 080）
            'tel2' => isset($phoneParts[1]) ? $phoneParts[1] : '', // 電話番号の2番目の部分（例: 1234）
            'tel3' => isset($phoneParts[2]) ? $phoneParts[2] : '', // 電話番号の3番目の部分（例: 5678）
            'address' => $this->faker->address,                  // ランダムな住所
            'building' => $this->faker->word,                    // ランダムなビル名
            'textarea' => $this->faker->text,                       // ランダムな詳細
            'created_at' => now(),                                // 現在の日時
            'updated_at' => now(),
        ];
    }
}
