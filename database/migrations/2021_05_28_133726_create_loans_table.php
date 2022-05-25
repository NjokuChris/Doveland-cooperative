<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->string('members_id');
            $table->float('loanamount');
            $table->integer('tenor');
            $table->string('interest_rate');
            $table->float('interestamount');
            $table->float('monthlydeduction');
            $table->float('total_payable_amount');
            $table->date('loans_date');
            $table->string('loan_type_id');
            $table->string('paystartperiod_id');
            $table->string('payendperiod_id');
            $table->integer('transID');
            $table->string('transcode')->nullable();
            $table->string('LoanstatusID')->nullable();
            $table->integer('period_id')->nullable();
            $table->string('posted_by')->nullable();
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
        Schema::dropIfExists('loans');
    }
}
