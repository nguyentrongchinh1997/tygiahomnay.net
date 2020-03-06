<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnInGoldDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gold_details', function (Blueprint $table) {
            $table->string('city', 255)->nullable()->change();
            $table->string('type', 255)->nullable()->change();
            $table->string('buy')->nullable()->change();
            $table->string('sell')->nullable()->change();
            $table->string('type_slug', 500)->after('type');
            $table->renameColumn('city', 'city_id');
            // $table->integer('city_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gold_details', function (Blueprint $table) {
            $table->string('type', 255)->nullable(false)->change();
            $table->string('buy')->nullable(false)->change();
            $table->string('sell')->nullable(false)->change();
            $table->dropColumn('type_slug');
        });
    }
}

