<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    
    public function up(): void
    {
        // Add status column if it doesn't exist
        if (!Schema::hasColumn('cats', 'status')) {
            Schema::table('cats', function (Blueprint $table) {
                $table->string('status')->default('available')->after('photo');
            });

            // Update all existing cats to have "available" status
            DB::table('cats')->update(['status' => 'available']);
        }
    }

    
    public function down(): void
    {
        Schema::table('cats', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
