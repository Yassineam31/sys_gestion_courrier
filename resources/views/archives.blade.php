<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الأرشيفات</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="style/dashboardCSS.css">
    <link rel="stylesheet" href="style/sideBar.css">
</head>
<body dir="rtl">
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
    <div class="content closed" id="mainContent">
        <div class="container">
            <div class="row justify-content-center" style="margin-top: 100px;">
                <div class="col-lg-6 col-sm-12 mb-3">
                    <a href="{{route('archivesEntrants')}}" class="button courrierEntrant" style='text-decoration:none;color:black;position:relative;right:200px;'>
                        <i class="fa-solid fa-inbox me-2" style="font-size:30px;"></i> أرشيف البريد الوارد
                    </a>
                </div>
                <div class="col-lg-6 col-sm-12 mb-3">
                    <a href="{{route('archivesSortant')}}" class="button courrierSortant" style='text-decoration:none;color:black;margin-right:15px'>
                        <i class="fa-regular fa-envelope me-2" style="font-size:30px;"></i> أرشيف البريد الصادر
                    </a>
                </div>
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
