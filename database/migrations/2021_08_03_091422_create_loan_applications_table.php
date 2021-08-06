<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_applications', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('gender');
            $table->mediumText('homeAddress');
            $table->string('phoneNumber');
            $table->string('email');
            $table->string('occupation');
            $table->integer('monthlySalary');
            $table->string('maritalStatus');
            $table->string('refereeName');
            $table->string('refereePhonenumber');
            $table->string('BVN');
            $table->enum('loanStatus', ['pending', 'approved'])->default('pending');
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
        Schema::dropIfExists('loan_applications');
    }
}
