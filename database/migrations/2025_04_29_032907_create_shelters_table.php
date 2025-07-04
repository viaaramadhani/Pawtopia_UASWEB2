<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('shelters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('location');
            $table->string('contact')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
          });
    }

    public function down(): void
    {
        Schema::dropIfExists('shelters');
    }
};
