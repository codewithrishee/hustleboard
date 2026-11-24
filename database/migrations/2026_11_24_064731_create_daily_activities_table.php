<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::create('daily_activities', function (Blueprint $table) {
        $table->id();
        $table->date('activity_date')->unique();
        $table->unsignedInteger('jobs_applied')->default(0);
        $table->unsignedInteger('leads_found')->default(0);
        $table->unsignedInteger('calls_made')->default(0);
        $table->unsignedInteger('messages_sent')->default(0);
        $table->unsignedInteger('follow_ups')->default(0);
        $table->unsignedInteger('replies_received')->default(0);
        $table->unsignedInteger('meetings')->default(0);
        $table->unsignedInteger('clients_won')->default(0);
        $table->unsignedInteger('learning_minutes')->default(0);
        $table->text('notes')->nullable();
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('daily_activities');
}
};
