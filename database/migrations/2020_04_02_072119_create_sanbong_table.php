<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSanbongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sanbong', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('ten');
            $table->tinyInteger('songuoi');
            $table->string('diachi');
            $table->string('mota')->nullable();
            $table->string('sdt',16);
            $table->string('link')->nullable();
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
        Schema::dropIfExists('sanbong');
    }
}
