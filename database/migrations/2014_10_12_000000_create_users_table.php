h<?php

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
        Schema::create(TablesEnum::USERS->value, function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_admin')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
        $this->insertAdmin();
    }

    private function insertAdmin(): void
    {
        \Illuminate\Support\Facades\DB::table(TablesEnum::USERS->value)
            ->insert([
                'id' => 1,
                'first_name' => 'alireza',
                'last_name' => 'mousavi',
                'email' => env('ADMIN_EMAIL'),
                'password' => bcrypt(env('ADMIN_PASSWORD')),
                'email_verified_at' => now(),
                'is_admin' => true,
                'created_at' => now(),
            ]);
    }

    /**
     * Reverse the migrations.
     *
     */
    public function down(): void
    {
        Schema::dropIfExists(TablesEnum::USERS->value);
    }
};
