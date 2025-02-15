<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCategoryIdInContactsTable extends Migration
{
    public function up()
    {
        // contactsテーブルのcategory_idが'商品のお届けについて'の場合、category_idを1に更新
        DB::table('contacts')
            ->where('category_id', '商品のお届けについて')
            ->update(['category_id' => 1]);
        DB::table('contacts')
            ->where('category_id', '商品の交換について')
            ->update(['category_id' => 2]);
        DB::table('contacts')
            ->where('category_id', '商品トラブル')
            ->update(['category_id' => 3]);
        DB::table('contacts')
            ->where('category_id', 'ショップへのお問い合わせ')
            ->update(['category_id' => 4]);
        DB::table('contacts')
            ->where('category_id', 'その他')
            ->update(['category_id' => 5]);

        Schema::table('contacts', function (Blueprint $table) {

            // category_id のデータ型を unsignedBigInteger に変更
            $table->unsignedBigInteger('category_id')->change();
            // 外部キー制約を追加
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    public function down()
    {
        // 必要であれば、更新した内容を元に戻す処理を記述
        DB::table('contacts')
            ->where('category_id', 1)
            ->update(['category_id' => '商品のお届けについて']);
        DB::table('contacts')
            ->where('category_id', 2)
            ->update(['category_id' => '商品の交換について']);
        DB::table('contacts')
            ->where('category_id', 3)
            ->update(['category_id' => '商品トラブル']);
        DB::table('contacts')
            ->where('category_id', 4)
            ->update(['category_id' => 'ショップへのお問い合わせ']);
        DB::table('contacts')
            ->where('category_id', 5)
            ->update(['category_id' => 'その他']);

        Schema::table('contacts', function (Blueprint $table) {
            // 外部キー制約を削除
            $table->dropForeign(['category_id']);
            // category_id カラムを元の型に戻す
            $table->string('category_id')->change();
        });
    }
}