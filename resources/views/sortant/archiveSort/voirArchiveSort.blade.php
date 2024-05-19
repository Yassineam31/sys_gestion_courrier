<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>عرض البريد</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<style>
    span {
        font-size: 15px;
        font-weight: 600;
    }
</style>
<body>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header" style='background-color:#353b49; color:white; font-weight:700;'>
                معلومات البريد الصادر
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card-body">
                        <p class="card-title"><span>المرجع: </span> {{ $courrier->Reference }}</p>
                        <p class="card-text"><span>المرسل اليه :</span> {{ $courrier->Destinataire }}</p>
                        <p class="card-text"><span>الموضوع :</span> {{ $courrier->ObjetCorrespondance }}</p>
                        <p class="card-text"><span>تاريخ الإرسال :</span> {{ $courrier->DateEnvoiAcademie }}</p>
                        <p class="card-text"><span>مراسلة تستلزم الجواب :</span> {{ $courrier->CorrespondanceRequiertReponse }}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <p class="card-text"><span>تم الرد عليها :</span> {{ $courrier->ReponseRecue }}</p>
                        <p class="card-text"><span>آخر أجل للرد :</span> {{ $courrier->DernierDelaiReceptionReponse }}</p>
                        <p class="card-text"><span>حالة المراسلة :</span> {{ $courrier->Statut }}</p>
                        <p class="card-text"><span>المرفقات :</span>{{ asset($courrier->TelechargementCorrespondance) }}<a href="{{ asset($courrier->TelechargementCorrespondance) }}" style='font-weight:700;text-decoration:none;margin-right:10px' download >تحميــــل </a></p>
                    </div>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header" style="background-color:#353b49; color:white; font-weight:700;">
                    # مشاركة مع
                </div>
                <form action="/partagerCourrier" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="checkbox" id="partage1" name="partage1" class="form-check-input">
                                    <label for="partage1" class="form-check-label">المدير</label>
                                </div>
                                <div class="mb-3">
                                    <input type="checkbox" id="partage2" name="partage2" class="form-check-input">
                                    <label for="partage2" class="form-check-label">الكتابة الخاصة للسيد المدير</label>
                                </div>
                                <div class="mb-3">
                                    <input type="checkbox" id="partage3" name="partage3" class="form-check-input">
                                    <label for="partage3" class="form-check-label">مكتب الضبط</label>
                                </div>
                                <div class="mb-3">
                                    <input type="checkbox" id="partage4" name="partage4" class="form-check-input">
                                    <label for="partage4" class="form-check-label">قسم الشؤون الإدارية والمالية</label>
                                </div>
                                <div class="mb-3">
                                    <input type="checkbox" id="partage5" name="partage5" class="form-check-input">
                                    <label for="partage5" class="form-check-label">قسم تدبير الموارد البشرية</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="checkbox" id="partage6" name="partage6" class="form-check-input">
                                    <label for="partage6" class="form-check-label">قسم التخطيط والخريطة المدرسية</label>
                                </div>
                                <div class="mb-3">
                                    <input type="checkbox" id="partage7" name="partage7" class="form-check-input">
                                    <label for="partage7" class="form-check-label">قسم الشؤون التربوية</label>
                                </div>
                                <div class="mb-3">
                                    <input type="checkbox" id="partage8" name="partage8" class="form-check-input">
                                    <label for="partage8" class="form-check-label">المركز الجهوي لمنظومة الإعلام في حكم قسم</label>
                                </div>
                                <div class="mb-3">
                                    <input type="checkbox" id="partage9" name="partage9" class="form-check-input">
                                    <label for="partage8" class="form-check-label">أعضاء القسم</label>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="mb-3">
                            <label for="remarque" class="form-label">ملاحظات :</label>
                            <textarea class="form-control" id="remarque" name="remarque" rows="3"></textarea>
                        </div>
                        <input type="hidden" name="reference" value="{{ $courrier->Reference }}">
                        <input type="hidden" name="destinataire" value="{{ $courrier->Destinataire }}">
                        <input type="hidden" name="objet" value="{{ $courrier->ObjetCorrespondance }}">
                        <input type="hidden" name="date_envoi" value="{{ $courrier->DateEnvoiAcademie }}">
                        <input type="hidden" name="correspondance_reponse" value="{{ $courrier->CorrespondanceRequiertReponse }}">
                        <input type="hidden" name="repondu" value="{{ $courrier->ReponseRecue }}">
                        <input type="hidden" name="dernier_delai" value="{{ $courrier->DernierDelaiReceptionReponse }}">
                        <input type="hidden" name="statut" value="{{ $courrier->Statut }}">
                        <input type="hidden" name="telechargement" value="{{ $courrier->TelechargementCorrespondance }}">

                        <button type="submit" class="btn btn-dark">إرسال</button>
                    </div>
                </form>
            </div>
        </div>
        <a href="/archivesSortant" class="btn btn-success mt-2" style="width:100px;display:block; margin:0 auto; font-weight:700;">رجــــــــوع</a>
    </div>
</body>
</html>
