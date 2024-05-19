<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;


class courrierEntrant extends Controller
{
    public function show(){
        $dbData = DB::table('courriers_entrants')->orderBy('created_at', 'desc')->paginate(5);
        return view('entrant.courrierEntrant',['donnees'=>$dbData]);
        
    }
    public function insertData(Request $request){
        $request->validate([
            'expediteur'=>'required',
            'correspondance_reponse'=>'required',
            'sujet'=>'required',
            'telechargement'=>'required'
        ],[
            'expediteur.required' => 'يرجى تقديم معلومات المرسل.',
            'correspondance_reponse.required' => 'يرجى تحديد ما إذا كانت المراسلة تتطلب الرد أم لا.',
            'sujet.required' => 'يرجى تحديد موضوع المراسلة.',
            'telechargement.required' => 'يرجى تحميل المراسلة.',

            
        ]);
        $reference=$request['reference'];
        $expediteur=$request['expediteur'];
        $numero_inscription=$request['numero_inscription'];
        $date_inscription=$request['date_inscription'];
        $date_envoi_entite=$request['date_envoi_entite'];
        $numero_envoi=$request['numero_envoi'];
        $correspondance_reponse=$request['correspondance_reponse'];
        $repondu=$request['repondu'];
        $dernier_delai=$request['dernier_delai'];
        $sujet=$request['sujet'];
        $telechargement=$request['telechargement'];
        $statut=$request['statut'];
        DB::insert('INSERT INTO courriers_entrants(`Reference`, `Expediteur`, `NumeroInscriptionAcademie`,
        `DateInscriptionAcademie`,`DateEnvoiEntiteExpeditrice`,`NumeroEnvoiEntiteExpeditrice`,
        `CorrespondanceRequiertReponse`, `Repondu`, `DernierDelaiReponse`, `SujetCorrespondance`,
        `TelechargementCorrespondance`, `Statut`)
        VALUES(?,?,?,?,?,?,?,?,?,?,?,?)',[
            $reference,$expediteur,$numero_inscription,
            $date_inscription,$date_envoi_entite,$numero_envoi,
            $correspondance_reponse,$repondu,$dernier_delai,$sujet,
            $telechargement,$statut
        ]);
        return redirect('courrierEntrant');
    } 

    public function showToUpdateData($code){
        $dbData = DB::select('select * from courriers_entrants where id=?', [$code]);
        if (!empty($dbData)) {
            return view('entrant.modifierData', ['donnee' => $dbData, 'id' => $code]);
        } else {
            return redirect()->back()->with('error', 'Aucun enregistrement trouvé.');
        }
    }
    public function saveUpdatedData(Request $request,$id){
        $request->validate([
            'expediteur'=>'required',
            'correspondance_reponse'=>'required',
            'sujet'=>'required',
            'telechargement' => $request->hasFile('telechargement') ? 'required' : ''
        ],[
            'expediteur.required' => 'يرجى تقديم معلومات المرسل.',
            'correspondance_reponse.required' => 'يرجى تحديد ما إذا كانت المراسلة تتطلب الرد أم لا.',
            'sujet.required' => 'يرجى تحديد موضوع المراسلة.',
            'telechargement.required' => 'يرجى تحميل المراسلة.',

            
        ]);
        $reference=$request['reference'];
        $expediteur=$request['expediteur'];
        $numero_inscription=$request['numero_inscription'];
        $date_inscription=$request['date_inscription'];
        $date_envoi_entite=$request['date_envoi_entite'];
        $numero_envoi=$request['numero_envoi'];
        $correspondance_reponse=$request['correspondance_reponse'];
        $repondu=$request['repondu'];
        $dernier_delai=$request['dernier_delai'];
        $sujet=$request['sujet'];
        $telechargement=$request['telechargement'];
        $statut=$request['statut'];
        $telechargement = $request->hasFile('telechargement') ? $request->file('telechargement')->storeAs('telechargements', $request->file('telechargement')->getClientOriginalName()) : $request->input('ancien_telechargement');
        DB::update('update courriers_entrants SET `Reference`=?, `Expediteur`=?, `NumeroInscriptionAcademie`=?, 
        `DateInscriptionAcademie`=?, `DateEnvoiEntiteExpeditrice`=?, `NumeroEnvoiEntiteExpeditrice`=?, 
        `CorrespondanceRequiertReponse`=?, `Repondu`=?, `DernierDelaiReponse`=?, `SujetCorrespondance`=?, 
        `TelechargementCorrespondance`=?, `Statut`=?  WHERE id=?',[
            $reference,$expediteur,$numero_inscription,
            $date_inscription,$date_envoi_entite,$numero_envoi,
            $correspondance_reponse,$repondu,$dernier_delai,$sujet,
            $telechargement,$statut,$id
        ]);
        return redirect('courrierEntrant');
    }
    public function deleteIncoming($id){
        DB::delete('delete from courriers_entrants where id=?',[$id]);
        return redirect('courrierEntrant');
    }
        
    public function showCourrier($id) {
       
        $courrier = DB::table('courriers_entrants')->find($id);
        if (!$courrier) {
            abort(403);
        }
        return view('entrant.voirCourrier', ['courrier' => $courrier]);
    }
    //les methodes des Archives Entrants

    public function showArchive(){
        $dbArchiveData = DB::table('archives_entrants')->orderBy('created_at', 'desc')->paginate(5);
        return view('entrant.archiveEnt.archiveCourrierEntrant',['donnees'=>$dbArchiveData]);
    }

    public function archiveEnt($id){
        DB::transaction(function() use ($id){
            DB::insert('insert into archives_entrants select * from courriers_entrants where id=?',[$id]);
            DB::delete('delete from courriers_entrants where id=?',[$id]);
        });
        return redirect('courrierEntrant');
    }
    public function modifierArchiveEnt($code){
        $dbData = DB::select('select * from archives_entrants where id=?', [$code]);
        if (!empty($dbData)) {
            return view('entrant.archiveEnt.modifierArchiveEnt', ['donnee' => $dbData, 'id' => $code]);
        } else {
            return redirect()->back()->with('error', 'Aucun enregistrement trouvé.');
        }
    }
    public function saveArchiveEntrant(Request $request,$id){
        $request->validate([
            'expediteur'=>'required',
            'correspondance_reponse'=>'required',
            'sujet'=>'required',
            'telechargement' => $request->hasFile('telechargement') ? 'required' : ''
        ],[
            'expediteur.required' => 'يرجى تقديم معلومات المرسل.',
            'correspondance_reponse.required' => 'يرجى تحديد ما إذا كانت المراسلة تتطلب الرد أم لا.',
            'sujet.required' => 'يرجى تحديد موضوع المراسلة.',
            'telechargement.required' => 'يرجى تحميل المراسلة.',

            
        ]);
        $reference=$request['reference'];
        $expediteur=$request['expediteur'];
        $numero_inscription=$request['numero_inscription'];
        $date_inscription=$request['date_inscription'];
        $date_envoi_entite=$request['date_envoi_entite'];
        $numero_envoi=$request['numero_envoi'];
        $correspondance_reponse=$request['correspondance_reponse'];
        $repondu=$request['repondu'];
        $dernier_delai=$request['dernier_delai'];
        $sujet=$request['sujet'];
        $telechargement=$request['telechargement'];
        $statut=$request['statut'];
        $telechargement = $request->hasFile('telechargement') ? $request->file('telechargement')->storeAs('telechargements', $request->file('telechargement')->getClientOriginalName()) : $request->input('ancien_telechargement');
        DB::update('update archives_entrants SET `Reference`=?, `Expediteur`=?, `NumeroInscriptionAcademie`=?, 
        `DateInscriptionAcademie`=?, `DateEnvoiEntiteExpeditrice`=?, `NumeroEnvoiEntiteExpeditrice`=?, 
        `CorrespondanceRequiertReponse`=?, `Repondu`=?, `DernierDelaiReponse`=?, `SujetCorrespondance`=?, 
        `TelechargementCorrespondance`=?, `Statut`=?  WHERE id=?',[
            $reference,$expediteur,$numero_inscription,
            $date_inscription,$date_envoi_entite,$numero_envoi,
            $correspondance_reponse,$repondu,$dernier_delai,$sujet,
            $telechargement,$statut,$id
        ]);
        return redirect('archivesEntrants');
    }
    public function deleteArchiveEnt($id){
        DB::delete('delete from archives_entrants where id=?',[$id]);
        return redirect('/archivesEntrants');
    }
    public function voirArchiveEnt($id) {
        $courrier = DB::table('archives_entrants')->find($id);
    
        if (!$courrier) {
            abort(403); 
        }
    
        return view('entrant.archiveEnt.voirArchiveEnt', ['courrier' => $courrier]);
    }  
}