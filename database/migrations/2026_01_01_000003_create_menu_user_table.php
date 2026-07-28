<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('MENU_USER', function (Blueprint $table) {
            $table->integer('no_setting')->autoIncrement()->primary();
            $table->string('id_user', 30)->nullable();
            $table->string('menu_id', 3)->nullable();
            $table->timestamp('create_date')->nullable();
            $table->timestamp('create_time')->nullable();
            $table->string('delete_mark', 1)->nullable();
            $table->string('update_by', 30)->nullable();
            $table->timestamp('update_date')->nullable();

            $table->foreign('id_user')
                ->references('id_user')
                ->on('USER')
                ->nullOnDelete();

            $table->foreign('menu_id')
                ->references('menu_id')
                ->on('MENU')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('MENU_USER');
    }
};
