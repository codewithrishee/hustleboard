<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
{
    Schema::create('leads', function (Blueprint $table) {
        $table->id();
        $table->string('business_name');
        $table->string('category')->nullable();
        $table->string('contact_person')->nullable();
        $table->string('phone')->nullable();
        $table->string('email')->nullable();
        $table->string('website')->nullable();
        $table->string('instagram')->nullable();
        $table->string('area')->nullable();
        $table->text('problem_identified')->nullable();
        $table->string('service_offered')->nullable();
        $table->string('source')->nullable();
        $table->string('status')->default('New');
        $table->date('follow_up_date')->nullable();
        $table->decimal('quoted_price', 10, 2)->nullable();
        $table->text('notes')->nullable();
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('leads');
}
};
