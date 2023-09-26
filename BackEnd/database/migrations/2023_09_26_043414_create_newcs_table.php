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
        Schema::create('newcs', function (Blueprint $table) {
            $table->id('title');
            $table->string('slug');
            $table->text('content');
            $table->date('public_date');
            $table->string('new_image');
            $table->unsignedBigInteger('new_categorie_id');

            $table->foreign('new_categorie_id')->references('id')->on('new_categories');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newcs');
    }
};
