<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();

            // Collation compatible accents
            $table->string('title')
                  ->collation('utf8mb4_unicode_ci');

            $table->text('content')
                  ->collation('utf8mb4_unicode_ci');

            $table->unsignedBigInteger('author_id');

            $table->string('image_path')->nullable();
            $table->timestamp('published_at')->nullable();

            $table->timestamps();

            // Foreign key
            $table->foreign('author_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });

        // Important : forcer charset + collation de la table
        Schema::table('articles', function (Blueprint $table) {
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
