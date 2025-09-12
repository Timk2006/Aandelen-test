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
        Schema::table('transacties', function (Blueprint $table) {
             $table->enum('type', ['buy', 'sell'])->after('prijs_per_stuk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transacties', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
