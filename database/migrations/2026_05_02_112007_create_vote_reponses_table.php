<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up() {
    Schema::create('vote_reponses', function (Blueprint $table) {
        $table->id();
        $table->foreignId('vote_id')->constrained()->onDelete('cascade');
        $table->foreignId('resident_id')->constrained()->onDelete('cascade');
        $table->string('choix');
        $table->timestamps();
        $table->unique(['vote_id', 'resident_id']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vote_reponses');
    }
};
