<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->dateTime('transaction_date');
            $table->integer('period_id');
            $table->text('naration');
            $table->string('transcode');
            $table->string('account_no');
            $table->float('credit');
            $table->float('debit');
            $table->float('amount');
            $table->integer('location_id');
            $table->string('subaccountcode');
            $table->string('reversal_status');
            $table->timestamps();
            $table->integer('member_id');
            $table->integer('salary_group_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
