<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('USER_FOTO', function (Blueprint $table) {
            $table->integer('no_foto')->autoIncrement()->primary();
            $table->string('id_user', 30)->nullable();
            $table->string('foto', 200)->nullable();
            $table->string('create_by', 30)->nullable();
            $table->timestamp('create_date')->nullable();
            $table->string('delete_mark', 1)->nullable();
            $table->string('update_by', 30)->nullable();
            $table->timestamp('update_date')->nullable();

            $table->foreign('id_user')
                ->references('id_user')
                ->on('USER')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('USER_FOTO');
    }
};
