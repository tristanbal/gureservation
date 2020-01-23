<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWaitlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waitlists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('groupName');
            $table->string('employeeID');
            $table->string('title');
            $table->integer('roomPerSetUpID');
            $table->string('referenceID');
            $table->date('reserveStartDate');
            $table->date('reserveEndDate');
            $table->time('reserveStartTime');
            $table->time('reserveEndTime');
            $table->integer('pax');
            $table->string('personInCharge');
            $table->string('personInChargeEmail');
            $table->string('personInChargeContact');
            
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
        Schema::dropIfExists('waitlists');
    }
}
