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
        Schema::create('pelatihans', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('name');
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->enum('training_type', ['Fitness', 'Yoga', 'Pilates'])->default('Fitness');
            $table->text('description')->nullable();
            $table->enum('status', ['Upcoming', 'On Progress', 'Finish'])->default('Upcoming');
            $table->timestamp('tanggal_jam')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelatihans');
    }
};
