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
    Schema::create('votes', function (Blueprint $table) {
        $table->id();
        $table->foreignId('copropriete_id')->constrained()->onDelete('cascade');
        $table->string('titre');
        $table->text('description')->nullable();
        $table->json('options');
        $table->enum('statut', ['ouvert', 'ferme'])->default('ouvert');
        $table->dateTime('date_fin');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
