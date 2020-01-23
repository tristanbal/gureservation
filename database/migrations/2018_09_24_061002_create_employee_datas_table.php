<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeDatasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_datas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employeeID')->unique;
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->string('nameSuffix');
            $table->integer('jobID');
            $table->integer('bandID');
            $table->integer('groupID');
            $table->integer('divisionID');
            $table->integer('departmentID');
            $table->integer('sectionID');
            $table->string('email');
            $table->string('phoneNumber');
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
        Schema::dropIfExists('employee_datas');
    }
}
