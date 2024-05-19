<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>تعديل بيانات البريد الصادر</title>
</head>
<style>
    .custom-file-input,.statut {
        width: auto;
    }
    .form-check-label,.form-check-input {
        display: inline-block;
        margin-right: 30px;
    }
    .fa-solid{
        margin-right: 10px; 
    }
    button{
        width: 150px;
        position: absolute;
        left:100px;
        
    }
</style>
<body >
    <div class="container">
        <h1 class="text-center mb-4">تعديل بيانات البريد الصادر</h1>
        <form action="{{ url('/saveArchiveSortant', $id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <div class="col">
                    <label for="reference" class="form-label">المرجع :</label>
                    <input type="text" class="form-control" id="reference" name="Reference" value="{{$donnee[0]->Reference}}">
                </div>
                <div class="col">
                    <label for="destinataire" class="form-label">المرسل اليه<span style='color:red;'>*</span>:</label>
                    <input type="text" class="form-control" id="destinataire" name="Destinataire" value="{{$donnee[0]->Destinataire}}">
                    @error('destinataire')
                    <span class='text-danger'>{{$message}}</span>
                    @enderror
                </div>
                <div class="col">
                    <label for="Numero_envoi_academie" class="form-label">رقم إرسال الأكاديمية :</label>
                    <input type="text" class="form-control" id="Numero_envoi_academie" name="Numero_envoi_academie" value="{{$donnee[0]->NumeroEnvoiAcademie}}">
                </div>
            <div class="row mb-3">
                <div class="col-md-4">
                        <label for="date_envoi_par_academie" class="form-label">تاريخ إرسال بالأكاديمية :</label>
                        <input type="date" class="form-control" id="date_envoi_par_academie" name="date_envoi_par_academie" value="{{$donnee[0]->DateEnvoiAcademie}}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label" for="Dernier_delai_reception_reponse">آخر أجل لاستقبال الجواب :</label>
                        <input type="date" class="form-control" id="Dernier_delai_reception_reponse" name="Dernier_delai_reception_reponse" value="{{$donnee[0]->DernierDelaiReceptionReponse}}">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="mb-3 form-check d-flex align-items-center">
                        <label class="form-check-label mb-0 mr-3" for="correspondance_reponse_oui">مراسلة تستلزم الجواب <span style='color:red;'>*</span>:</label>
                        <input type="radio" class="form-check-input" id="correspondance_reponse_oui" name="Correspondance_requiert_reponse" value="نعم" {{$donnee[0]->CorrespondanceRequiertReponse == 'نعم' ? 'checked' : ''}}>
                        <label class="form-check-label mb-0 mr-2" for="correspondance_reponse_oui">نعم</label>
                        <input type="radio" class="form-check-input" id="correspondance_reponse_non" name="Correspondance_requiert_reponse" value="لا" {{$donnee[0]->CorrespondanceRequiertReponse == 'لا' ? 'checked' : ''}}>
                        <label class="form-check-label mb-0" for="correspondance_reponse_non">لا</label>
                    </div>
                    @error('Correspondance_requiert_reponse')
                    <span class='text-danger'>{{$message}}</span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <div class="form-check d-flex align-items-center">
                        <label class="form-check-label mb-0 mr-3" for="repondu_oui">تم استقبال الجواب :</label>
                        <input type="radio" class="form-check-input" id="repondu_oui" name="Reponse_recue" value="نعم" {{$donnee[0]->ReponseRecue == 'نعم' ? 'checked' : ''}}>
                        <label class="form-check-label mb-0 mr-2" for="repondu_oui">نعم</label>
                        <input type="radio" class="form-check-input" id="repondu_non" name="Reponse_recue" value="لا"{{$donnee[0]->ReponseRecue == 'لا' ? 'checked' : ''}}>
                        <label class="form-check-label mb-0" for="repondu_non">لا</label>
                    </div>
                </div>
            </div>
                <div class="mb-3">
                    <label for="Objet_correspondance" class="form-label">موضوع المراسلة <span style='color:red;'>*</span>:</label>
                    <textarea class="form-control" id="Objet_correspondance" name="Objet_correspondance" rows="3">{{$donnee[0]->ObjetCorrespondance}}</textarea>
                    @error('Objet_correspondance')
                    <span class='text-danger'>{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="telechargement" class="form-label">تحميل المراسلة <span style='color:red;'>*</span>:</label>
                    <input type="file" class="form-control custom-file-input" id="telechargement" name="telechargement">
                    @if($donnee[0]->TelechargementCorrespondance)
                        <!-- Afficher le nom du fichier actuellement téléchargé -->
                        <p>{{ basename($donnee[0]->TelechargementCorrespondance) }}</p>
                        <!-- Champ caché pour stocker le chemin du fichier déjà téléchargé -->
                        <input type="hidden" name="ancien_telechargement" value="{{$donnee[0]->TelechargementCorrespondance}}">
                    @endif
                    @error('telechargement')
                        <span class='text-danger'>{{$message}}</span>
                    @enderror
                </div>

            <div class="mb-3">
                <label for="statut" class="form-label">الحالة :</label>
                <select class="form-select statut" id="statut" name="statut">
                    <option value="في الإنتظار" {{ $donnee[0]->Statut == "في الإنتظار" ? 'selected' : '' }}>في الإنتظار</option>
                    <option value="قيد المعالجة" {{ $donnee[0]->Statut == "قيد المعالجة" ? 'selected' : '' }}>قيد المعالجة</option>
                    <option value="مكتمل" {{ $donnee[0]->Statut == "مكتمل" ? 'selected' : '' }}>مكتمل</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">حــفظ التغيير<i class="fa-solid fa-floppy-disk"></i></button>
        </form>
        
    </div>
</body>
</html>
