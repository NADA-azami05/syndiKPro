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
    Schema::create('fournisseurs', function (Blueprint $table) {
        $table->id();
        $table->string('nom');
        $table->enum('categorie', ['plomberie', 'electricite', 'nettoyage', 'securite', 'autre']);
        $table->string('telephone')->nullable();
        $table->string('email')->nullable();
        $table->text('adresse')->nullable();
        $table->decimal('note', 3, 1)->default(0);
        $table->boolean('actif')->default(true);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fournisseurs');
    }
};
