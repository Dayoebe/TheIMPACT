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
        Schema::create('programmes', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('headline');
            $table->string('icon', 50)->default('equip');
            $table->string('category');
            $table->text('summary');
            $table->text('overview');
            $table->text('audience');
            $table->string('duration')->nullable();
            $table->string('registration_url')->nullable();
            $table->json('objectives');
            $table->json('curriculum');
            $table->json('facilitators');
            $table->json('cohorts');
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('sort_order')->default(0);
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programmes');
    }
};
