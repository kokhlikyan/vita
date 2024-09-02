<?php

use App\Enums\BlockRepeatTypes;
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
        Schema::create('blocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('title');
            $table->text('details')->nullable();
            $table->integer('repeat_every')->default(1);
            $table->enum('repeat_type', BlockRepeatTypes::getValues())->nullable();
            $table->json('repeat_on')->nullable();
            $table->date('start_date');
            $table->time('from_time')->nullable();
            $table->time('to_time')->nullable();
            $table->date('end_date')->nullable();
            $table->date('end_on')->nullable();
            $table->integer('end_after')->nullable();
            $table->string('color')->default('#4B5459');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blocks');
    }
};
