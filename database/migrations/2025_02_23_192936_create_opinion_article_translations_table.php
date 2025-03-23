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
        Schema::create('opinion_article_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('opinion_article_id');
            $table->string('locale')->index();

            $table->string('title');
            $table->string('short');
            $table->text('content');

            $table->foreign('opinion_article_id')->on('articles')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->unique(['opinion_article_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opinion_article_translations');
    }
};
