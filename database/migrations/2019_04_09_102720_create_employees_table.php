<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->string('polar_id', 20);
            $table->string('name', 50);
            $table->unsignedMediumInteger('dept_id',3);
            $table->unsignedMediumInteger('desig_id', 3);
            $table->unsignedMediumInteger('office_loc_id', 3);
            $table->unsignedMediumInteger('region_id', 2);
            $table->integer('mobile', 12);
            $table->string('grade', 20);
            $table->string('bloodgroup', 20)->nullable();
            $table->string('gender', 20);
            $table->string('job_status', 20)->nullable();
            $table->string('maritial_status', 20)->nullable();
            $table->string('present_address', 250)->nullable();
            $table->string('permanent_address', 250)->nullable();
            $table->string('status', 15);
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
        Schema::dropIfExists('employees');
    }
}
