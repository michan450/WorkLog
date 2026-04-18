<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
          $table->id();

          // 申請者
          $table->foreignId('user_id')->constrained()->cascadeOnDelete();

          // 対象の勤怠
          $table->foreignId('attendance_id')->constrained()->cascadeOnDelete();

          // ステータス
          $table->string('status', 20); // pending / approved / rejected
                                        

          // 備考
          $table->text('reason')->nullable();

          // 修正内容
          $table->dateTime('requested_check_in')->nullable();
          $table->dateTime('requested_check_out')->nullable();

           // 承認者
           $table->foreignId('approved_by')
            ->nullable()
            ->constrained('users')
            ->nullOnDelete();

           $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
}
