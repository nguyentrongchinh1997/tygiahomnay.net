<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeExchangeRateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exchange_rate', function (Blueprint $table) {
            $table->integer('currency_name_id')->nullable()->change();
            $table->string('buy', 100)->nullable()->change();
            $table->string('sell', 100)->nullable()->change();
            $table->string('transfer', 100)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exchange_rate', function (Blueprint $table) {
            $table->integer('currency_name_id')->nullable(false)->change();
            $table->string('buy', 100)->nullable(false)->change();
            $table->string('sell', 100)->nullable(false)->change();
            $table->string('transfer', 100)->nullable(false)->change();
        });
    }
}
