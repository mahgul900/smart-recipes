<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * This table stores admin-seeded ingredient alternatives.
     * User-submitted reviews go in alternative_reviews table.
     */
    public function up(): void
    {
        Schema::create('ingredient_alternatives', function (Blueprint $table) {
            $table->id();
            $table->string('ingredient');    // e.g. "butter"
            $table->string('alternative');   // e.g. "coconut oil"
            $table->text('notes')->nullable(); // optional description
            $table->timestamps();

            $table->index('ingredient');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ingredient_alternatives');
    }
};
