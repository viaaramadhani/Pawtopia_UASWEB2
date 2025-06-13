<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cats', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('ras')->nullable();
            $table->integer('age');
            $table->enum('gender', ['jantan', 'betina']);
            $table->string('photo')->nullable();
            $table->timestamps();
            $table->text('description')->nullable();
        }); 
    }

    public function down()
    {
        Schema::table('cats', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
};