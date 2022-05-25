<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {

           $table->increments('member_id');
           $table->string('member_no')->nullable();
           $table->string('title');
           $table->string('firstName');
           $table->string('middleName')->nullable();
           $table->string('surName');
           $table->string('member_name');
           $table->double('savings_amount');
           $table->timestamp('posted_date')->nullable();
           $table->integer('LocationID')->nullable();
           $table->timestamp('joined_date');
           $table->longText('H_address')->nullable();;
           $table->string('email');
           $table->string('phoneNo')->nullable();
           $table->boolean('is_staff')->nullable();
           $table->string('employee_no')->nullable();;
           $table->string('company')->nullable();
           $table->timestamp('date_birth')->nullable();
           $table->string('gender');
           $table->string('Home_location')->nullable();
           $table->string('H_state')->nullable();
           $table->integer('BankID')->nullable();
           $table->string('BankAcc_no')->nullable();
           $table->string('sort_code');
           $table->string('photo')->nullable();;
           $table->string('posted_by')->nullable();
           $table->string('member_status')->nullable();
           $table->string('sub_acc_code')->nullable();
           $table->double('membership_charges')->nullable();
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
        Schema::dropIfExists('members');
    }
}
