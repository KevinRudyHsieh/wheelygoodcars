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
        Schema::table('cars', function (Blueprint $table) {
            $table->integer('massa_ledig_voertuig')->nullable()->after('cilinderinhoud');
            $table->integer('massa_rijklaar')->nullable()->after('massa_ledig_voertuig');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn(['massa_ledig_voertuig', 'massa_rijklaar']);
        });
    }
};
