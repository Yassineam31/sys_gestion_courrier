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
        Schema::create('courriers_entrants', function (Blueprint $table) {
            $table->id();
            $table->string('Reference')->nullable();
            $table->string('Expediteur');
            $table->string('NumeroInscriptionAcademie')->nullable();
            $table->date('DateInscriptionAcademie')->nullable();
            $table->string('NumeroEnvoiEntiteExpeditrice')->nullable();
            $table->date('DateEnvoiEntiteExpeditrice')->nullable();
            $table->string('CorrespondanceRequiertReponse',4);
            $table->string('Repondu',4)->nullable();
            $table->date('DernierDelaiReponse')->nullable();
            $table->string('SujetCorrespondance',1000);
            $table->string('TelechargementCorrespondance');
            $table->string('Statut')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP')); // Ajoute la colonne created_at avec CURRENT_TIMESTAMP par défaut
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'))->useCurrentOnUpdate(); // Ajoute la colonne updated_at avec CURRENT_TIMESTAMP par défaut et mise à jour
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courriers_entrants');
    }
};
