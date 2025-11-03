<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCertificationCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certification_courses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedMediumInteger('employee_id');
            $table->string('name_course', 250);
            $table->string('institution', 250);
            $table->string('passing_year', 10)->nullable();
            $table->string('result', 20)->nullable();
            $table->string('remarks', 250)->nullable();
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
        Schema::dropIfExists('certification_courses');
    }
}
