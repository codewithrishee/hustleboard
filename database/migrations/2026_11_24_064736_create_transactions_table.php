<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('lead_id')->nullable()->constrained()->nullOnDelete();
        $table->string('type'); // income or expense
        $table->string('title');
        $table->decimal('amount', 10, 2);
        $table->date('transaction_date');
        $table->string('payment_status')->default('Received');
        $table->text('notes')->nullable();
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('transactions');
}
};
