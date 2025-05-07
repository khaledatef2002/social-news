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
        Schema::create('tv_article_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tv_article_id')->index();
            $table->string('locale')->index();

            $table->string('title');

            $table->foreign('tv_article_id')->references('id')->on('tv_articles')->onDelete('cascade')->onUpdate('cascade');
            $table->unique(['tv_article_id', 'locale'], 'tv_article_id_locale_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tv_article_translations');
    }
};
