<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style/dashboardCSS.css">
    <title>الرئيسية</title>
</head>
<body>
<div class="container d-Flex">
      <div class="d-Flex justify-content-between" style='margin: 0;'>
        <button class="btn btn-dark rounded-pill p-1 mt-2" title="خروج">
        <i class="fa-solid fa-right-from-bracket fa-flip-horizontal"></i>
        </button>
        <span class="my-4">{{ $currentDate }}</span>
      </div>
      <div dir="rtl">
        <h6>إسم المستخدم :</h6>
        <h3>الرئيسية</h3>
        <div class="dashboard">
          <div class="G1">
            <a href="{{route('courrierEntrant')}}" class="button courrierEntrant" style='text-decoration:none;color:black;'>
                <i class="fa-solid fa-inbox" style='font-size:30px;'></i>
                البريد الوارد
            </a>
            <a href="" class="button membres" style='text-decoration:none;color:black;'>
                <i class="fa-solid fa-user-group" style='font-size:30px;'></i>
                الأعـضاء
            </a>
          </div>
          <div class="G2">
            <a href="{{route('courrierSortant')}}" class="button courrierSortant" style='text-decoration:none;color:black;'>
                <i class="fa-regular fa-envelope" style='font-size:30px;'></i>
                البريد الصادر
            </a>
            <a href="" class="button rechercher" style='text-decoration:none;color:black;'>
                <i class="fa-solid fa-magnifying-glass" style='font-size:30px;'></i>
                بحـث
            </a>
            
          </div>
          <div class="G3">
            <a href="{{route('archives')}}" class="button archive" style='text-decoration:none;color:black;'>
                <i class="fa-solid fa-box-archive" style='font-size:30px;'></i>
                الأرشـيف
            </a>
            <a href="" class="button notifications" style='text-decoration:none;color:black;'>
                <i class="fa-solid fa-bell" style='font-size:30px;'></i>
                تنبيهـــات
            </a>
          </div>
        </div>
      </div>
    </div>
</body>
</html>