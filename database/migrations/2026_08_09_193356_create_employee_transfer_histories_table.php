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
        Schema::create('employee_transfer_histories', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('employee_id');

            $table->string('transfer_type')->nullable();

            $table->date('effective_date')->nullable();

            $table->unsignedBigInteger('previous_department_id')->nullable();
            $table->unsignedBigInteger('new_department_id')->nullable();

            $table->unsignedBigInteger('previous_reporting_to')->nullable();
            $table->unsignedBigInteger('new_reporting_to')->nullable();

            $table->unsignedBigInteger('previous_office_location_id')->nullable();
            $table->unsignedBigInteger('new_office_location_id')->nullable();

            $table->text('transfer_reason')->nullable();

            $table->text('remarks')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_transfer_histories');
    }
};
