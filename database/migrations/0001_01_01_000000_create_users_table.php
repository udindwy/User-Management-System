<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('USER', function (Blueprint $table) {
            $table->string('id_user', 30)->primary();
            $table->string('nama_user', 80)->nullable();
            $table->string('username', 60)->unique();
            $table->string('password', 60)->nullable();
            $table->string('email', 200)->nullable();
            $table->string('no_hp', 30)->nullable();
            $table->string('wa', 30)->nullable();
            $table->string('pin', 30)->nullable();
            $table->string('id_jenis_user', 3)->nullable();
            $table->string('status_user', 30)->nullable();
            $table->string('delete_mark', 1)->nullable();
            $table->string('create_by', 30)->nullable();
            $table->timestamp('create_date')->nullable();
            $table->string('update_by', 30)->nullable();
            $table->timestamp('update_date')->nullable();

            $table->foreign('id_jenis_user')
                ->references('id_jenis_user')
                ->on('JENIS_USER')
                ->nullOnDelete();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('user_id', 30)->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('USER');
    }
};
