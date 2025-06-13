<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
   
    public function up(): void
    {
        Schema::table('adoptions', function (Blueprint $table) {
            $table->boolean('certificate_generated')->default(false)->after('status');
            $table->foreignId('user_id')->nullable()->after('cat_id')->constrained();
        });
    }

    
    public function down(): void
    {
        Schema::table('adoptions', function (Blueprint $table) {
            $table->dropColumn('certificate_generated');
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
