<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApprovalProcessFlowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('approval_process_flows', function (Blueprint $table) {
            $table->id();
            $table->integer('process_module_id');
            $table->integer('approval_stage_id');
            $table->integer('process_no');
            $table->integer('active_id');
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
        Schema::dropIfExists('approval__process_flows');
    }
}
