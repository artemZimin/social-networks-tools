<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if(!Schema::hasTable('vk_access_tokens')) {
            Schema::create('vk_access_tokens', function (Blueprint $table) {
                $table->id();
                $table->string('access_token')->unique();
                $table->integer('expires_in');
                $table->integer('user_id')->unique();
                $table->unsignedBigInteger('fk_user_id');
                $table->foreign('fk_user_id')
                    ->references('id')
                    ->on('users')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('vk_access_tokens');
    }
};
