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
    Schema::create('factures', function (Blueprint $table) {
        $table->id();
        $table->foreignId('resident_id')->constrained()->onDelete('cascade');
        $table->string('numero')->unique();
        $table->string('mois');
        $table->json('charges');
        $table->decimal('total', 10, 2);
        $table->enum('statut', [
            'brouillon',
            'envoyee',
            'en_attente_confirmation',
            'payee',
            'retard'
        ])->default('envoyee');
        $table->date('echeance');
        $table->date('date_paiement')->nullable();
        $table->string('stripe_payment_intent')->nullable();
        $table->string('stripe_client_secret')->nullable();
        $table->string('preuve_path')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
