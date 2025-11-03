<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedMediumInteger('employee_id');
            $table->string('child_name', 250)->nullable();
            $table->string('gender', 10)->nullable();
            $table->datetime('date_of_birth')->nullable();
            $table->string('institution', 250)->nullable();
            $table->string('class_name', 250)->nullable();
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
        Schema::dropIfExists('child_details');
    }
}
