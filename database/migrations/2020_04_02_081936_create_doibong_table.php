<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoibongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doibong', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('ten');
            $table->string('trinhdo');
            $table->text('diachi')->nullable();
            $table->string('sdt')->nullable();
            $table->integer('sodiem')->comment('số điểm sẽ được tổng từ bảng kết quả. thắng +3 hòa +0 thua -1')->default(0);
            $table->integer('hanhkiem')->default(0)->comment('set tổng số vote. lấy % đá đẹp/tổng vote');
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
        Schema::dropIfExists('doibong');
    }
}
