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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title')->index('idx_title_blog');
            $table->string('slug')->index('idx_slug_blog');
            $table->string('status')->index('idx_status_blog')->default('pending');
            $table->tinyInteger('is_active')->default(true)->index('idx_active_blog');
            $table->text('content')->nullable();
            $table->text('description')->nullable();
            $table->integer('release_at')->nullable();
            $table->integer('created_at');
            $table->integer('updated_at');
            $table->integer('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
