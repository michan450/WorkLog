<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
          $table->id();
          $table->foreignId('user_id')->constrained()->cascadeOnDelete();
          $table->date('date');
          $table->dateTime('check_in')->nullable();
          $table->dateTime('check_out')->nullable();
          $table->string('status', 20); // 勤務外 / 出勤中 / 休憩中 / 退勤済
          $table->timestamps();

          // 1日1レコード制約
          $table->unique(['user_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}
