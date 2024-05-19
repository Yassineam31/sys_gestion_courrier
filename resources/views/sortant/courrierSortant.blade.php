<!DOCTYPE html>
<html lang="ar" dir='rtl'>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style/sideBar.css">
    <link rel="stylesheet" href="style/courrierSortantCSS.css">
    <title>البريد الصادر</title>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar closed" id="sidebar">
        <!-- Bouton de bascule -->
        <div id="toggleSidebar" style='color:#fff;background-color:#000;margin:15px 10px;'>
            <i class="fa fa-bars" style='font-size:25px;margin-right:5px;'></i>
        </div>
        <!-- Liens du menu -->
        <div class="menu">
            <a href="/dashboard" class="link"><i class="fa fa-th" style='font-size:23px;margin-right:5px;'></i> <span class="link_text">الرئيسية</span></a>
            <a href="/courrierEntrant" class="link"><i class="fa-solid fa-envelope-open" style='font-size:23px;margin-right:5px;'></i> <span class="link_text">البريد الوارد</span></a>
            <a href="/courrierSortant" class="link"><i class="fa-solid fa-paper-plane" style='font-size:23px;margin-right:5px;'></i> <span class="link_text">البريد الصادر</span></a>
            <a href="/archives" class="link"><i class="fa-solid fa-box-archive" style='font-size:23px; margin-right:5px;'></i><span class="link_text">الأرشيف</span></a>
            <a href="/notifications" class="link"><i class="fa-solid fa-bell" style='font-size:23px; margin-right:5px;'></i> <span class="link_text">تنبيهات</span></a>
            <a href="/recherche" class="link"><i class="fa-solid fa-magnifying-glass" style='font-size:23px; margin-right:5px;'></i> <span class="link_text">بحث</span></a>
            <a href="/membres" class="link"><i class="fa-solid fa-user-group" style='font-size:23px; margin-right:5px;'></i> <span class="link_text">أعضاء</span></a>
        </div>
        <!-- Bouton de fermeture -->
        <div class="closeSidebar">
            <button id="closeSidebar" class="btn btn-link"><i class="fa-solid fa-forward-fast"></i></button>
        </div>
    </div>
    <!-- Contenu principal -->
    <div class="mainContent closed" id="mainContent">
        <div class="container">
            @if(count($donnees) > 0)
            <table class='table table-striped table-hover mt-5'>
                <tr>
                    <td colspan='7' style="background-color: #353b49;">
                         <div class="d-flex" style="position:relative;">
                            <button class="btn btn-ajouter"><a href="/AddSortant" style="text-decoration:none;color:#000;font-weight:500;"><i class="fa-solid fa-circle-plus"></i>إضافة بريد</a></button>
                            <input type="search" dir="rtl" placeholder="بحث..." class="form-control m-2 search" style="width: 150px;">
                            <h4 class='courrier-sortant'>البريد الصادر</h4>
                        </div> 
                    </td>
                </tr>
                <tr dir='rtl'>
                    <th>المرجع</th>
                    <th>المرسل إليه</th>
                    <th>رقم إرسال الأكاديمية</th>
                    <th>تاريخ إرسال بالأكاديمية</th>
                    <th>موضوع المراسلة</th>
                    <th>الحالة</th>
                    <th>الإجراء</th>
                </tr>
                @foreach($donnees as $donnee)
                <tr>
                    <td>{{$donnee->Reference}}</td>
                    <td>{{$donnee->Destinataire}}</td>
                    <td>{{$donnee->NumeroEnvoiAcademie}}</td>
                    <td>{{$donnee->DateEnvoiAcademie}}</td>
                    <td style="max-width: 200px; word-wrap: break-word;">{{$donnee->ObjetCorrespondance}}</td>
                    <td>{{$donnee->Statut}}</td>
                    <td>
                        <a href="/archiverSortant/{{$donnee->id}}" title='أرشفة'><i class="fa-solid fa-inbox"></i></a> |<a href="/modifier-sortant/{{$donnee->id}}" title='تغيير'><i class="fa-solid fa-pen-to-square"></i></a><br>
                        <a href="/voir-sortant/{{$donnee->id}}" title='إظهار'> <i class="fa-solid fa-eye"></i></a> | <button id="openModalBtn{{$donnee->id}}" title='مسح'><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
            <!-- The Modal -->
             <div id="myModal{{$donnee->id}}" class="modal">
                    <!-- Modal content -->
                    <div class="modal-content">
                        <span class="close" style='cursor:pointer;'><i class="fa-solid fa-xmark"></i></span>
                        <p class='text text-center fw-bold'>هل تريد حذف هذا البريد ؟</p>
                        <div class="btn-container">
                            <form method="POST" action="{{ route('delete-Outgoing', ['id' => $donnee->id]) }}">
                                @csrf
                                @method('DELETE')
                                <button class='btn bg-danger text-white fw-bold' type="submit" >حـــــذف</button>
                            </form>
                            <!-- Button to close the modal -->
                            <a class='btn' style='border:1px solid silver;font-weight:700;' href="/courrierSortant">رجــــــوع</a>
                        </div>
                    </div>
                </div>
                <!-- JavaScript to control the Modal -->
            <script>
                // Function to handle modal events
                function setupModalEvents(modalId, openBtnId) {
                    // Get the modal
                    var modal = document.getElementById(modalId);

                    // Get the button that opens the modal
                    var btn = document.getElementById(openBtnId);

                    // Get the <span> element that closes the modal
                    var span = modal.querySelector(".close");

                    // When the user clicks on the button, open the modal
                    btn.addEventListener("click", function() {
                        modal.style.display = "block";
                    });

                    // When the user clicks on <span> (x), close the modal
                    span.addEventListener("click", function() {
                        modal.style.display = "none";
                    });

                    // When the user clicks anywhere outside of the modal, close it
                    window.addEventListener("click", function(event) {
                        if (event.target == modal) {
                            modal.style.display = "none";
                        }
                    });
                }

                // Call the function to set up modal events for this iteration
                setupModalEvents("myModal{{$donnee->id}}", "openModalBtn{{$donnee->id}}");
            </script>
                @endforeach
                </table>
             @else
            <button class="btn btn-ajouter" style=''>
                <a href="/AddSortant" style="text-decoration:none;color:#000;font-weight:500;">
                <i class="fa-solid fa-circle-plus"></i>إضافة بريد</a>
            </button>
            @endif
            <div dir='ltr' class="pagination-centered">
                {{ $donnees->links() }}
            </div>
        </div>
    </div>
    <!-- JavaScript -->
    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            var content = document.getElementById('mainContent');
            sidebar.classList.toggle('closed');
            content.classList.toggle('closed');
        }

        function closeSidebar() {
            var sidebar = document.getElementById('sidebar');
            var content = document.getElementById('mainContent');
            sidebar.classList.add('closed');
            content.classList.add('closed');
        }

        document.getElementById('toggleSidebar').addEventListener('click', toggleSidebar);
        document.getElementById('closeSidebar').addEventListener('click', closeSidebar);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
