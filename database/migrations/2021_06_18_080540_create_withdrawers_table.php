<?php

use App\Models\withdrawer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawers', function (Blueprint $table) {
            $table->id();
            $table->string('withdrawer_id');
            $table->unsignedInteger('member_id');
            $table->float('amount');
            $table->text('naration');
            $table->integer('transID');
            $table->string('posted_by');
            $table->timestamps();
            $table->date('withdrawer_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('withdrawers');
    }
}
