<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('job_applications', function (Blueprint $table) {
        $table->string('company_name')->after('id');
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
    });
}

public function down(): void
{
    Schema::table('job_applications', function (Blueprint $table) {
        $table->dropColumn([
            'company_name',
            'role',
            'location',
            'salary',
            'job_link',
            'applied_date',
            'status',
            'hr_contact',
            'follow_up_date',
            'interview_date',
            'notes',
        ]);
    });
}
};
