<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('employee_training_histories', function (Blueprint $table) {

            $table->string('certificate_path')
                  ->nullable()
                  ->after('training_location');

        });
    }

    public function down()
    {
        Schema::table('employee_training_histories', function (Blueprint $table) {

            $table->dropColumn('certificate_path');

        });
    }
};