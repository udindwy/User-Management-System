<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('L_ERROR_APPLICATION', function (Blueprint $table) {
            $table->integer('error_id')->autoIncrement()->primary();
            $table->string('id_user', 30)->nullable();
            $table->date('error_date')->nullable();
            $table->string('modules', 100)->nullable();
            $table->string('controller', 200)->nullable();
            $table->string('function', 200)->nullable();
            $table->string('error_line', 30)->nullable();
            $table->string('error_message', 1000)->nullable();
            $table->string('status', 30)->nullable();
            $table->string('param', 300)->nullable();
            $table->timestamp('create_date')->nullable();
            $table->string('create_time', 30)->nullable();
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
        Schema::dropIfExists('L_ERROR_APPLICATION');
    }
};
