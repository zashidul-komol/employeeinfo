<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('employee_training_histories', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('employee_id');

            $table->string('training_name');

            $table->string('training_type')->nullable();

            $table->string('training_provider')->nullable();

            $table->date('start_date')->nullable();

            $table->date('end_date')->nullable();

            $table->string('duration')->nullable();

            $table->string('training_location')->nullable();

            $table->string('certificate_path')->nullable();

            $table->string('status')->nullable();

            $table->text('remarks')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_training_histories');
    }

};
