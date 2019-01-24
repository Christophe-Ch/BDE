<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BDE CESI ROUEN</title>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/layout.css">
    <link rel="stylesheet" href="/css/buttons.css">
    @yield('stylesheets')
</head>
<body>
    <div class="left">
        <h1 id="title_left">@yield('title')</h1>
        @yield('content_form')
    </div>
    <div class="right">
        @yield('img')
    </div>
    <script>
        var profilModal = document.getElementById('profil_modal');
        var profilModalBtn = document.getElementById('profil_img_change');

        profilModalBtn.onclick = function(){
            profilModal.style.display = "block";
        }
        window.onclick = function(event){
            if(event.target == profilModal){
                profilModal.style.display = "none";
            }
        }
    </script>
</body>
</html>