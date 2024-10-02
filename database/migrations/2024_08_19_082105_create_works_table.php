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
        Schema::create('works', function (Blueprint $table) {
            $table->ulid('id')->primary()->comment('ID');
            $table->char('user_id', 26)->comment('ワーカーID');
            $table->timestamp('start_work_time')->nullable()->comment('労働開始時間');
            $table->timestamp('end_work_time')->nullable()->comment('労働終了時間');
            $table->timestamp('start_break_time')->nullable()->comment('休憩開始時間');
            $table->timestamp('end_break_time')->nullable()->comment('休憩終了時間');
            $table->decimal('working_hours', 5, 2)->nullable()->comment('労働時間(時間単位)');
            $table->decimal('night_working_hours', 5, 2)->nullable()->comment('深夜労働時間(時間単位)');
            $table->integer('daily_wage')->nullable()->comment('賃金');
            $table->boolean('completed_flg')->default(false)->comment('労働終了フラグ');
            $table->boolean('approval_flg')->default(false)->comment('承認済フラグ');
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
        Schema::dropIfExists('works');
    }
};
