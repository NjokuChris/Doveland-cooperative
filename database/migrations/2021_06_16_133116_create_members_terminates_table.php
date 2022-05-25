<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTerminatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members_terminates', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('member_id');
            $table->foreign('member_id')->references('member_id')->on('members');
            $table->unsignedInteger('terminate_type_id');
            $table->text('reason');
            $table->integer('period_id');
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
        Schema::dropIfExists('members_terminates');
    }
}
