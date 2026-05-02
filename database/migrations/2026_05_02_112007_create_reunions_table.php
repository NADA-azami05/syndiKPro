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
    Schema::create('reunions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('copropriete_id')->constrained()->onDelete('cascade');
        $table->string('titre');
        $table->dateTime('date');
        $table->string('lieu');
        $table->text('ordre_jour')->nullable();
        $table->string('pv_path')->nullable();
        $table->enum('statut', ['planifiee', 'terminee', 'annulee'])->default('planifiee');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reunions');
    }
};
