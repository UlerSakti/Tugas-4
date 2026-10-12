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
    Schema::create('games', function (Blueprint $table) {
        $table->id(); // PK
        $table->foreignId('category_id')->constrained()->onDelete('cascade'); // FK
        $table->string('title');
        $table->string('slug')->unique();
        $table->string('developer');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
