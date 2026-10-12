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
    Schema::create('orders', function (Blueprint $table) {
        $table->id(); // PK
        $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // FK
        $table->foreignId('payment_method_id')->constrained(); // FK
        $table->foreignId('voucher_id')->nullable()->constrained(); // FK
        $table->string('invoice_number')->unique();
        $table->decimal('total_amount', 12, 2);
        $table->string('status')->default('pending'); // aman untuk PgSQL
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
