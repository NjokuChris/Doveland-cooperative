<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommPeriodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comm_periods', function (Blueprint $table) {
            $table->id();
            $table->string('comm_period');
            $table->dateTime('date_from');
            $table->dateTime('date_to');
            $table->string('status');
            $table->integer('posted_by')->nullable();
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
        Schema::dropIfExists('comm_periods');
    }
}
