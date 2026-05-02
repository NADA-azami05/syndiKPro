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
    Schema::create('interventions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('fournisseur_id')->constrained()->onDelete('cascade');
        $table->foreignId('copropriete_id')->constrained()->onDelete('cascade');
        $table->foreignId('reclamation_id')->nullable()->constrained()->onDelete('set null');
        $table->string('titre');
        $table->text('description')->nullable();
        $table->date('date_intervention');
        $table->decimal('cout', 10, 2)->default(0);
        $table->enum('statut', ['planifiee', 'en_cours', 'terminee'])->default('planifiee');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interventions');
    }
};
