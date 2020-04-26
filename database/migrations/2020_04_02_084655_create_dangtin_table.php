<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDangtinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dangtin', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('doidangtin_id');
            $table->integer('doibatdoi_id')->default(-1);
            $table->date('ngay');
            $table->string('keo');
            $table->integer('san_id');
            $table->integer('khunggio_id');
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
        Schema::dropIfExists('dangtin');
    }
}
