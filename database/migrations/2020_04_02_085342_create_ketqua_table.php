<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKetquaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ketqua', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('dangtin_id');
            $table->integer('doidangtin_id');
            $table->integer('banthanga');
            $table->integer('doibatdoi_id');
            $table->integer('banthangb');
            $table->string('hkdoidangtin')->comment('sẽ được đội bắt đối vote');
            $table->string('hkdoibatdoi')->comment('sẽ được đội đăng tin vote');
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
        Schema::dropIfExists('ketqua');
    }
}
