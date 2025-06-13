<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('adoptions', function (Blueprint $table) {
        // Menghapus foreign key constraint
        $table->dropForeign(['user_id']);
        // Menghapus kolom user_id
        $table->dropColumn('user_id');
    });
}

public function down(): void
{
    Schema::table('adoptions', function (Blueprint $table) {
        $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
    });
}
};