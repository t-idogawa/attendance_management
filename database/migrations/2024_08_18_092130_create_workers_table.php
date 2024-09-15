<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->ulid('id')->primary()->comment('ID');
            $table->char('store_id', 26)->comment('店舗ID');
            $table->string('last_name')->comment('性');
            $table->string('first_name')->comment('名');
            $table->string('last_name_kana')->comment('性カナ');
            $table->string('first_name_kana')->comment('名カナ');
            $table->string('mail')->comment('メールアドレス');
            $table->string('phone', 11)->comment('電話番号');
            $table->integer('gender')->comment('性別');
            $table->dateTime('birthday')->comment('生年月日');
            $table->string('post_code')->comment('郵便番号');
            $table->string('address')->comment('住所');
            $table->dateTime('hire_date')->comment('雇入日');
            $table->dateTime('retirement_date')->nullable()->comment('退職日');
            $table->string('reason_for_retirement')->nullable()->comment('退職事由');
            $table->integer('post_number')->comment('役職');
            $table->boolean('license_flg')->default(false)->comment('資格フラグ');
            $table->integer('hourly_pay')->nullable()->comment('時給');
            $table->timestamp('deleted_at')->nullable()->comment('削除日時');
            $table->string('created_account_id', 26)->comment('作成者ID');
            $table->timestamp('created_at')->useCurrent()->comment('作成日時');
            $table->string('updated_account_id', 26)->comment('更新者ID');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate()->comment('更新日時');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workers');
    }
};
