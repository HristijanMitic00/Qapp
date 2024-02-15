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
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->string('description');
            $table -> integer('category_id') -> unsigned() -> default(0);
            $table->foreign('category_id')
                ->references('id')->on('categories')
                ->onDelete('cascade');
            $table -> integer('admin_id') -> unsigned() -> default(0);
            $table->foreign('admin_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
            $table->float('rating')->default(0);
            $table->integer('timesRated')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
