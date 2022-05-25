<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->string('receipts_id');
            $table->string('subaccountcode');
            $table->integer('order_id');
            $table->float('amount_paid');
            $table->string('account_no');
            $table->integer('method_pay');
            $table->string('paid_by');
            $table->integer('location_id');
            $table->text('naration');
            $table->string('posted_by');
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
        Schema::dropIfExists('receipts');
    }
}
