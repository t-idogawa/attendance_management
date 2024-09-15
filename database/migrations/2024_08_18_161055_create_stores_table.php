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
        Schema::create('stores', function (Blueprint $table) {
            $table->ulid('id')->primary()->comment('ID');
            $table->string('name')->comment('店舗名');
            $table->string('tel', 11)->comment('電話番号');
            $table->string('address')->comment('店舗住所');
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
        Schema::dropIfExists('stores');
    }
};
