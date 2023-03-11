<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aids', function (Blueprint $table) {
            $table->integer('lastProcessing')->nullable();
            $table->integer('maxProcessing')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('aids', function (Blueprint $table) {
            $table->dropColumn('lastProcessing');
            $table->dropColumn('maxProcessing');
        });
    }
};
