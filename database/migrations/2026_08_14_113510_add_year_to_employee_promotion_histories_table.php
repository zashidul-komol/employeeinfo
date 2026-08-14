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
        Schema::table('employee_promotion_histories', function (Blueprint $table) {
            $table->unsignedSmallInteger('year')
                  ->nullable()
                  ->after('effective_date');
        });
    }

    public function down()
    {
        Schema::table('employee_promotion_histories', function (Blueprint $table) {
            $table->dropColumn('year');
        });
    }
};
