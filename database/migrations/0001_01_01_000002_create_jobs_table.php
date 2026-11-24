<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('job_applications', function (Blueprint $table) {
        $table->id();
        $table->string('company_name');
        $table->string('role');
        $table->string('location')->nullable();
        $table->string('salary')->nullable();
        $table->text('job_link')->nullable();
        $table->date('applied_date')->nullable();
        $table->string('status')->default('Saved');
        $table->string('hr_contact')->nullable();
        $table->date('follow_up_date')->nullable();
        $table->date('interview_date')->nullable();
        $table->text('notes')->nullable();
        $table->timestamps();
    });
}

public function down(): void
{
    Schema::dropIfExists('job_applications');
}
};
