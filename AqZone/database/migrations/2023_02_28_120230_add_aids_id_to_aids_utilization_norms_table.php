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
        Schema::table('aids_utilization_norms', function (Blueprint $table) {
            $table->bigInteger('aids_id')->unsigned()->nullable();
            $table->foreign('aids_id')
                ->references('aids_id')
                ->on('aids')
                ->onDelete('cascade');
            $table->date('register_date')->nullable();
            $table->integer('min_multiplicity')->nullable();
            $table->integer('max_multiplicity')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('aids_utilization_norms', function (Blueprint $table) {
            $table->dropColumn('aids_id');
            $table->dropColumn('register_date');
            $table->dropColumn('min_multiplicity');
            $table->dropColumn('max_multiplicity');
        });
    }
};
