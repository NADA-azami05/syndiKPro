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
    Schema::create('coproprietes', function (Blueprint $table) {
        $table->id();
        $table->string('nom');
        $table->string('adresse');
        $table->string('ville');
        $table->integer('nb_lots')->default(0);
        $table->decimal('budget', 12, 2)->default(0);
        $table->string('syndic_nom')->nullable();
        $table->timestamps();
    });
}
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coproprietes');
    }
};
