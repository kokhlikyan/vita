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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('block_id')->nullable();
            $table->integer('goal_id')->nullable()->comment('can choose one of these goals or habits');
            $table->integer('habit_id')->nullable()->comment('can choose one of these goals or habits');
            $table->string('title');
            $table->text('details')->nullable();
            $table->boolean('completed')->default(false);
            $table->boolean('urgent')->default(false);
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->timestamps();
            $table->index('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
