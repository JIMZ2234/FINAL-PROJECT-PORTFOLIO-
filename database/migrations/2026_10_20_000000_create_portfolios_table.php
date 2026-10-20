<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Table already exists (from the first project): only add the owner column
        if (Schema::hasTable('portfolios')) {
            if (!Schema::hasColumn('portfolios', 'user_id')) {
                Schema::table('portfolios', function (Blueprint $table) {
                    $table->foreignId('user_id')->nullable()->after('id')
                          ->constrained()->cascadeOnDelete();
                });
            }
            return;
        }

        // Fresh database: create the full table
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();
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
        if (Schema::hasColumn('portfolios', 'user_id')) {
            Schema::table('portfolios', function (Blueprint $table) {
                $table->dropConstrainedForeignId('user_id');
            });
        }
    }
};