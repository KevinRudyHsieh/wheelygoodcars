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
            $table->decimal('catalogusprijs', 10, 2)->nullable()->after('horsepower');
            $table->string('vervaldatum_apk')->nullable()->after('catalogusprijs');
            $table->integer('aantal_wielen')->nullable()->after('vervaldatum_apk');
            $table->integer('aantal_cilinders')->nullable()->after('aantal_wielen');
            $table->integer('cilinderinhoud')->nullable()->after('aantal_cilinders');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn([
                'catalogusprijs',
                'vervaldatum_apk',
                'aantal_wielen',
                'aantal_cilinders',
                'cilinderinhoud',
            ]);
        });
    }
};
