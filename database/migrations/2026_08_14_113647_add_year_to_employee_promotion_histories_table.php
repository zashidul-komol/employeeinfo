<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('employee_promotion_histories2026_08_14_113510_add_year_to_employee_promotion_histories_table', function (Blueprint $table) {
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employee_promotion_histories2026_08_14_113510_add_year_to_employee_promotion_histories_table', function (Blueprint $table) {
            //
        });
    }
};
