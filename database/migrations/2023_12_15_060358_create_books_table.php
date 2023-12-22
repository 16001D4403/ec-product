<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('BookID');
            $table->string('Title');
            $table->string('Author');
            $table->string('ISBN');
            $table->string('Genre');
            $table->string('Publisher');
            $table->unsignedSmallInteger('Year');
            $table->decimal('Price', 8, 2);
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            // Add other columns as necessary

            $table->timestamps(); // Adds created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
