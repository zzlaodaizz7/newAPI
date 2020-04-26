<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoibongNguoidungTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doibong_nguoidung', function (Blueprint $table) {
            $table->id();
            $table->integer('doibong_id');
            $table->integer('user_id');
            $table->integer('phanquyen_id');
            $table->integer('trangthai')->comment('0-xin vào đội ---- 1- đã là thành viên của đội');
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
        Schema::dropIfExists('doibong_nguoidung');
    }
}
