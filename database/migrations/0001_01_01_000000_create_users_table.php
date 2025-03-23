<?php

use App\Enum\EducationType;
use App\Enum\UserType;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('image')->nullable();
            $table->smallInteger('country_code');
            $table->string('phone');
            $table->enum('education', [
                EducationType::PRIMARY->value,
                EducationType::SECONDARY->value,
                EducationType::BACHELORS->value,
                EducationType::MASTERS->value,
                EducationType::DOCTORATE->value,
            ]);
            $table->string('position');
            $table->string('x_link');
            $table->string('facebook_link');
            $table->string('instagram_link');
            $table->string('linkedin_link');
            $table->boolean('phone_public');
            $table->boolean('country_public');
            $table->boolean('education_public');
            $table->boolean('position_public');
            $table->boolean('x_link_public');
            $table->boolean('facebook_link_public');
            $table->boolean('instagram_link_public');
            $table->boolean('linkedin_link_public');
            $table->boolean('admin');
            $table->enum('type', [UserType::USER->value, UserType::WRITER->value]);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
