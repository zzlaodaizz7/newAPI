<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatdoiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batdoi', function (Blueprint $table) {
            $table->id();
            $table->integer('dangtin_id');
            $table->integer('doitimdoi_id');
            $table->integer('doibatdoi_id');
            $table->integer('trangthai')->default(0)->comment('0 chưa xác nhận - 1 xác nhận(khi xác nhận sẽ xóa những đội bắt đối khác)');
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
        Schema::dropIfExists('batdoi');
    }
}
