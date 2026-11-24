<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::create('outreach_logs', function (Blueprint $table) {
        $table->id();
        $table->foreignId('lead_id')->nullable()->constrained()->nullOnDelete();
        $table->string('method');
        $table->text('message')->nullable();
        $table->string('response_status')->default('Pending');
        $table->text('response')->nullable();
        $table->dateTime('contacted_at');
        $table->date('follow_up_date')->nullable();
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('outreach_logs');
}
};
