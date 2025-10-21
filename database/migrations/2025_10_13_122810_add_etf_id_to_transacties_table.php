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
        $table->foreignId('etf_id')->nullable()->constrained('etfs')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::table('transacties', function (Blueprint $table) {
        $table->dropForeign(['etf_id']);
        $table->dropColumn('etf_id');
    });
}
};
