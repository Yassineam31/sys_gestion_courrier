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
        Schema::create('courriers_sortants', function (Blueprint $table) {
            $table->id();
            $table->string('Reference')->nullable();
            $table->string('Destinataire');
            $table->string('NumeroEnvoiAcademie')->nullable();
            $table->date('DateEnvoiAcademie')->nullable();
            $table->string('ObjetCorrespondance', 1000);
            $table->string('CorrespondanceRequiertReponse', 10);
            $table->date('DernierDelaiReceptionReponse')->nullable();
            $table->string('ReponseRecue', 10)->nullable();
            $table->string('TelechargementCorrespondance');
            $table->string('Statut', 50)->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP')); // Ajoute la colonne created_at avec CURRENT_TIMESTAMP par défaut
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'))->useCurrentOnUpdate(); // Ajoute la colonne updated_at avec CURRENT_TIMESTAMP par défaut et mise à jour
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courriers_sortants');
    }
};
