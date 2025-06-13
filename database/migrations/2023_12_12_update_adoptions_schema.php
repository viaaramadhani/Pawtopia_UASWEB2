<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    
    public function up(): void
    {
        
        Schema::table('adoptions', function (Blueprint $table) {
            if (!Schema::hasColumn('adoptions', 'user_id')) {
                $table->foreignId('user_id')->nullable()->after('cat_id')->constrained()->onDelete('set null');
            }

            if (!Schema::hasColumn('adoptions', 'certificate_generated')) {
                $table->boolean('certificate_generated')->default(false)->after('status');
            }

            
            if (Schema::hasColumn('adoptions', 'adopter_description')) {
                // Get the column type
                $columnType = Schema::getColumnType('adoptions', 'adopter_description');

                
                if ($columnType !== 'text') {
                    $table->text('adopter_description')->nullable()->change();
                }
            }
        });
    }

    
    public function down(): void
    {
        // No need to reverse these changes
    }
};
