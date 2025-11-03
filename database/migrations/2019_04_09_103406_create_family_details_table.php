<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFamilyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedMediumInteger('employee_id');
            $table->string('father_name', 250);
            $table->string('father_occupation', 250)->nullable();
            $table->string('father_live_status', 10)->nullable();
            $table->string('mother_name', 250)->nullable();
            $table->string('mother_occupation', 250)->nullable();
            $table->string('mother_live_status', 10)->nullable();
            $table->string('wife_name', 250)->nullable();
            $table->string('wife_occupation', 250)->nullable();
            $table->datetime('wife_dob')->nullable();
            $table->string('no_of_brothers', 10)->nullable();
            $table->string('no_of_sisters', 10)->nullable();
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
        Schema::dropIfExists('family_details');
    }
}
