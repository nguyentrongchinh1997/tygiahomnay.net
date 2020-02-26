<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oils', function (Blueprint $table) {
            $table->increments('id');
            $table->string('oil_name', 255);
            $table->string('price_1', 100)->comment('giá vùng 1');
            $table->string('price_2', 100)->comment('giá vùng 2');
            $table->string('date');
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
        Schema::dropIfExists('oils');
    }
}
