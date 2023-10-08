<?php

use App\Enums\TablesEnum;
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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained(TablesEnum::USERS->value)
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('plan_id')
                ->constrained(TablesEnum::PLANS->value)
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->integer('count');
            $table->json('seats_numbers'); # TODO: make table for this column
            $table->timestamp('expires_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
