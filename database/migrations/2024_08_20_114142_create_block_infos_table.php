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
        Schema::create('block_infos', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId('block_id')->constrained('blocks')->cascadeOnDelete();
            $table->string('title');
            $table->text('details')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('block_infos');
    }
};
