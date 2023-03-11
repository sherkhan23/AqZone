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
        Schema::create('dosages', function (Blueprint $table) {
            $table->id('dosage_id');
            $table->bigInteger('aids_id')->unsigned()->nullable();
            $table->foreign('aids_id')
                ->references('aids_id')
                ->on('aids')
                ->onDelete('cascade');
            $table->bigInteger('aid_component_id')->unsigned()->nullable();
            $table->foreign('aid_component_id')
                ->references('aid_component_id')
                ->on('aid_components')
                ->onDelete('cascade');
            $table->bigInteger('unit_of_measure_id')->unsigned()->nullable();
            $table->foreign('unit_of_measure_id')
                ->references('unit_of_measure_id')
                ->on('unit_of_measures')
                ->onDelete('cascade');
            $table->double('dosage')->nullable();
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
        Schema::dropIfExists('dosages');
    }
};
