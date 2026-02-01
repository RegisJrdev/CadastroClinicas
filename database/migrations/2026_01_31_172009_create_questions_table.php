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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('type', ['text', 'number', 'date', 'select', 'textarea']);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });

        Schema::create('tenant_questions', function (Blueprint $table) {
            $table->id();
            $table->string('tenant_id');
            $table->foreignId('question_id')->constrained()->onDelete('cascade');
            $table->boolean('is_required')->default(false);
            $table->timestamps();

            $table->foreign('tenant_id')->references('id')->on('tenants')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_questions');
        Schema::dropIfExists('questions');
    }
};
