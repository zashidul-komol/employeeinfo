<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiblingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sibling_details', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedMediumInteger('employee_id');
            $table->string('sibling_name', 250);
            $table->string('occupation', 100);
            $table->string('age', 25)->nullable();
            $table->string('gender', 20)->nullable();
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
        Schema::dropIfExists('sibling_details');
    }
}
