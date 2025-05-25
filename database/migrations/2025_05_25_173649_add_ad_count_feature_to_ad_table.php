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
        Schema::table('ads', function (Blueprint $table) {
            $table->boolean('is_counted')->default(false)->after('redirect_link');
            $table->integer('max_views')->default(0)->after('is_counted');
            $table->integer('current_views')->default(0)->after('max_views');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ads', function (Blueprint $table) {
            $table->dropColumn('is_counted');
            $table->dropColumn('max_views');
            $table->dropColumn('current_views');
        });
    }
};
