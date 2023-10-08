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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('departure_city');
            $table->string('arrival_city');
            $table->string('departure_terminal');
            $table->string('arrival_terminal');
            $table->tinyInteger('departure_week_day');
            $table->timestamp('departure_time');
            $table->integer('duration');
            $table->integer('total_capacity');
            $table->integer('remain_capacity_r')
                ->default(0);
            $table->string('bus_type');
            $table->bigInteger('price_in_rial');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
