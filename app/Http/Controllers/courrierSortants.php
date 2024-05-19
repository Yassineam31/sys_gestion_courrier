<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class courrierSortants extends Controller
{
    public function showSortant(){
        //$dbData=DB::select('select * from courriers_sortants');
        $dbData = DB::table('courriers_sortants')->orderBy('created_at', 'desc')->paginate(5);
        return view('sortant.courrierSortant',['donnees'=>$dbData]);
        
    }
    public function insertDataSortant(Request $request){
        $request->validate([
            'Objet_correspondance'=>'required',
            'Destinataire'=>'required',
            'Correspondance_requiert_reponse'=>'required',
            'telechargement'=>'required'
        ],[
            'Objet_correspondance.required' => 'يرجى تحديد موضوع المراسلة.',
            'Destinataire.required' => ' يرجى تقديم معلومات المرسل إليه.',
            'Correspondance_requiert_reponse.required' => 'يرجى تحديد ما إذا كانت المراسلة تتطلب الرد أم لا.',
            'telechargement.required' => 'يرجى تحميل المراسلة.',

            
        ]);
        $Reference = $request['Reference'];
        $Destinataire = $request['Destinataire'];
        $NumeroEnvoiAcademie = $request['Numero_envoi_academie'];
        $DateEnvoiParAcademie = $request['date_envoi_par_academie'];
        $ObjetCorrespondance = $request['Objet_correspondance'];
        $CorrespondanceRequiertReponse = $request['Correspondance_requiert_reponse'];
        $DernierDelaiReceptionReponse = $request['Dernier_delai_reception_reponse'];
        $ReponseRecue = $request['Reponse_recue'];
        $telechargement=$request['telechargement'];
        $statut=$request['statut'];
        DB::insert('INSERT INTO courriers_sortants(`Reference`,`Destinataire`,`NumeroEnvoiAcademie`,
        `DateEnvoiAcademie`,`ObjetCorrespondance`,`CorrespondanceRequiertReponse`,
        `DernierDelaiReceptionReponse`,`ReponseRecue`,`TelechargementCorrespondance`,`Statut`)
        VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        [$Reference, $Destinataire, $NumeroEnvoiAcademie, $DateEnvoiParAcademie, 
        $ObjetCorrespondance, $CorrespondanceRequiertReponse, $DernierDelaiReceptionReponse, 
        $ReponseRecue, $telechargement, $statut]);
        return redirect('courrierSortant');

    } 

    public function showToUpdateData($code){
        $dbData = DB::select('select * from courriers_sortants where id=?', [$code]);
        return view('sortant.modifierDataSortant', ['donnee' => $dbData, 'id' => $code]);
        
    }
    
    
    
    public function saveUpdatedData(Request $request, $id){
        $request->validate([
            'Objet_correspondance'=>'required',
            'Destinataire'=>'required',
            'Correspondance_requiert_reponse'=>'required',
            'telechargement' => $request->hasFile('telechargement') ? 'required' : ''
        ],[
            'Objet_correspondance.required' => 'يرجى تحديد موضوع المراسلة.',
            'Destinataire.required' => ' يرجى تقديم معلومات المرسل إليه.',
            'Correspondance_requiert_reponse.required' => 'يرجى تحديد ما إذا كانت المراسلة تتطلب الرد أم لا.',
            'telechargement.required' => 'يرجى تحميل المراسلة.',
 
        ]);
        $courrier = DB::table('courriers_sortants')->find($id);
        $ancienne_reponse_recue = $courrier->ReponseRecue;
        $ancienne_correspondance_requiert_reponse = $courrier->CorrespondanceRequiertReponse;
        $Reference = $request['Reference'];
        $Destinataire = $request['Destinataire'];
        $NumeroEnvoiAcademie = $request['Numero_envoi_academie'];
        $DateEnvoiParAcademie = $request['date_envoi_par_academie'];
        $ObjetCorrespondance = $request['Objet_correspondance'];
        $CorrespondanceRequiertReponse = $request['Correspondance_requiert_reponse'];
        $DernierDelaiReceptionReponse = $request['Dernier_delai_reception_reponse'];
        $ReponseRecue = $request['Reponse_recue'];
        $telechargement=$request['telechargement'];
        $statut=$request['statut'];
    
        // Gérer le téléchargement de fichier s'il est présent
        $telechargement = $request->hasFile('telechargement') ? $request->file('telechargement')->storeAs('telechargements', $request->file('telechargement')->getClientOriginalName()) : $request->input('ancien_telechargement');
        if (!$request->has('Reponse_recue')) {
            $ReponseRecue = $ancienne_reponse_recue;
        }
        if (!$request->has('Correspondance_requiert_reponse')) {
            $CorrespondanceRequiertReponse = $ancienne_correspondance_requiert_reponse;
        }
         DB::update('update courriers_sortants SET `Reference`=?, `Destinataire`=?, `NumeroEnvoiAcademie`=?, 
    `DateEnvoiAcademie`=?, `ObjetCorrespondance`=?, `CorrespondanceRequiertReponse`=?, 
    `DernierDelaiReceptionReponse`=?, `ReponseRecue`=?, `TelechargementCorrespondance`=?,
    `Statut`=?  WHERE id=?',[
        $Reference, $Destinataire, $NumeroEnvoiAcademie,
        $DateEnvoiParAcademie, $ObjetCorrespondance, $CorrespondanceRequiertReponse,
        $DernierDelaiReceptionReponse, $ReponseRecue, $telechargement, $statut, $id
    ]);

    return redirect('courrierSortant'); // Rediriger vers la page de gestion des courriers sortants
    }
    
    public function deleteOutgoing($id){
        DB::delete('delete from courriers_sortants where id=?',[$id]);
        return redirect('courrierSortant');
    }
    

    
    public function showCourrier($id) {
        $courrier = DB::table('courriers_sortants')->find($id);
    
        if (!$courrier) {
            abort(403); // Si aucun courrier n'est trouvé, une erreur 403 est retournée
        }
    
        return view('sortant.voirCourrierSortant', ['courrier' => $courrier]);
    }  

    //les methodes des Archives Sortant

    public function showArchive(){
        $dbArchiveData = DB::table('archives_sortants')->orderBy('created_at', 'desc')->paginate(5);
        return view('sortant.archiveSort.archiveCourrierSortant',['donnees'=>$dbArchiveData]);
    }

    public function archiveSort($id){
        DB::transaction(function() use ($id){
            DB::insert('insert into archives_sortants select * from courriers_sortants where id=?',[$id]);
            DB::delete('delete from courriers_sortants where id=?',[$id]);
        });
        return redirect('courrierSortant');
    }

    public function modifierArchiveSort($code){
        $dbData = DB::select('select * from archives_sortants where id=?', [$code]);
        return view('sortant.archiveSort.modifierArchiveSort', ['donnee' => $dbData, 'id' => $code]);
        
    }
    
    public function saveArchiveSortant(Request $request, $id){
        $request->validate([
            'Objet_correspondance'=>'required',
            'Destinataire'=>'required',
            'Correspondance_requiert_reponse'=>'required',
            'telechargement' => $request->hasFile('telechargement') ? 'required' : ''
        ],[
            'Objet_correspondance.required' => 'يرجى تحديد موضوع المراسلة.',
            'Destinataire.required' => ' يرجى تقديم معلومات المرسل إليه.',
            'Correspondance_requiert_reponse.required' => 'يرجى تحديد ما إذا كانت المراسلة تتطلب الرد أم لا.',
            'telechargement.required' => 'يرجى تحميل المراسلة.',
 
        ]);
        $courrier = DB::table('archives_sortants')->find($id);
        $ancienne_reponse_recue = $courrier->ReponseRecue;
        $ancienne_correspondance_requiert_reponse = $courrier->CorrespondanceRequiertReponse;
        $Reference = $request['Reference'];
        $Destinataire = $request['Destinataire'];
        $NumeroEnvoiAcademie = $request['Numero_envoi_academie'];
        $DateEnvoiParAcademie = $request['date_envoi_par_academie'];
        $ObjetCorrespondance = $request['Objet_correspondance'];
        $CorrespondanceRequiertReponse = $request['Correspondance_requiert_reponse'];
        $DernierDelaiReceptionReponse = $request['Dernier_delai_reception_reponse'];
        $ReponseRecue = $request['Reponse_recue'];
        $telechargement=$request['telechargement'];
        $statut=$request['statut'];
    
        // Gérer le téléchargement de fichier s'il est présent
        $telechargement = $request->hasFile('telechargement') ? $request->file('telechargement')->storeAs('telechargements', $request->file('telechargement')->getClientOriginalName()) : $request->input('ancien_telechargement');
        if (!$request->has('Reponse_recue')) {
            $ReponseRecue = $ancienne_reponse_recue;
        }
        if (!$request->has('Correspondance_requiert_reponse')) {
            $CorrespondanceRequiertReponse = $ancienne_correspondance_requiert_reponse;
        }
         DB::update('update archives_sortants SET `Reference`=?, `Destinataire`=?, `NumeroEnvoiAcademie`=?, 
        `DateEnvoiAcademie`=?, `ObjetCorrespondance`=?, `CorrespondanceRequiertReponse`=?, 
        `DernierDelaiReceptionReponse`=?, `ReponseRecue`=?, `TelechargementCorrespondance`=?,
        `Statut`=?  WHERE id=?',[
            $Reference, $Destinataire, $NumeroEnvoiAcademie,
            $DateEnvoiParAcademie, $ObjetCorrespondance, $CorrespondanceRequiertReponse,
            $DernierDelaiReceptionReponse, $ReponseRecue, $telechargement, $statut, $id
        ]);
        return redirect('archivesSortant');
    }

    public function deleteArchiveSort($id){
        DB::delete('delete from archives_sortants where id=?',[$id]);
        return redirect('/archivesSortant');
    }
    public function voirArchiveSort($id) {
        $courrier = DB::table('archives_sortants')->find($id);
    
        if (!$courrier) {
            abort(403); // Si aucun courrier n'est trouvé, une erreur 403 est retournée
        }
    
        return view('sortant.archiveSort.voirArchiveSort', ['courrier' => $courrier]);
    }  
}
