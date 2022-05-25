<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('loans_id');
            $table->integer('payroll_id');
            $table->integer('member_id');
            $table->integer('salary_group_id');
            $table->float('amount2debit');
            $table->boolean('ispaid');
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
        Schema::dropIfExists('loans_schedules');
    }
}
