<?php

use App\Enums\BlockRepeatTypes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\BlockTypes;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('blocks', function (Blueprint $table) {
            $table->id();
            $table->uuid()->unique();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->boolean('all_day')->default(false);
            $table->integer('repeat_every')->nullable();
            $table->enum('repeat_type', BlockRepeatTypes::getValues())->nullable();
            $table->json('repeat_on')->nullable();
            $table->integer('day_of_week')->nullable();
            $table->integer('day_of_month')->nullable();
            $table->integer('month_of_year')->nullable();
            $table->date('start_date');
            $table->time('from_time');
            $table->time('to_time');
            $table->date('end_date')->nullable();
            $table->json('exclude_dates')->nullable();
            $table->date('end_on')->nullable();
            $table->integer('end_after')->nullable();
            $table->string('color')->default('#4B5459');
            $table->timestamps();
            $table->softDeletes();
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
