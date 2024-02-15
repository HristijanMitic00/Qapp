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
        Schema::create('match_questions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('text');
            $table->string('answer1');
            $table->string('match1');
            $table->string('answer2');
            $table->string('match2');
            $table->string('answer3');
            $table->string('match3');
            $table->string('answer4');
            $table->string('match4');
            $table -> integer('quiz_id') -> unsigned() -> default(0);
            $table->foreign('quiz_id')
                ->references('id')->on('quizzes')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('match_questions');
    }
};
