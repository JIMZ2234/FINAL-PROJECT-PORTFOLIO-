<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('full_name');
            $table->longText('profile_picture')->nullable();
            $table->string('email');
            $table->string('contact_number');
            $table->string('address');
            $table->text('about');
            $table->text('education')->nullable();
            $table->text('skills')->nullable();
            $table->text('projects')->nullable();
            $table->text('experience')->nullable();
            $table->text('links')->nullable();
            $table->unsignedTinyInteger('template')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};