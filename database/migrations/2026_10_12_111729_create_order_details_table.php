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
    Schema::create('order_details', function (Blueprint $table) {
        $table->id(); // PK
        $table->foreignId('order_id')->constrained()->onDelete('cascade'); // FK
        $table->foreignId('product_id')->constrained(); // FK
        $table->string('target_user_id'); // ID Game / Zone ID / Tagline
        $table->decimal('price', 12, 2);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
