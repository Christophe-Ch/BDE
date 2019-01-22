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
    <link rel="stylesheet" href="@yield('stylesheets')">
</head>
<body>
    <header>
        <div id="menu-bar">
            <img id="logo-menu" src="/images/Logo_bde.png" alt="Logo">

            <nav>
                <ul>
                    <li><a href="/">Accueil</a></li>
                    <li><a href="#">Événements</a></li>
                    <li><a href="#">Boite à idées</a></li>
                    <li><a href="#">Boutique</a></li>
                </ul>
            </nav>

            <div id="menu_profil">
                @if (Auth::check())
                    <div id="menu_profil_content">
                        <p id="user_name"><a href="">{{ Auth::user()->name }}</a></p>
                        <img id="user_icon" src="/images/user_icon.png" alt="user">
                        <ul id="submenu_profil">
                            <li><a href="#">Mon profil</a></li>
                            <li><a href="#">Mon panier</a></li>
                            <li><a href="#">Mes notifs</a></li>
                            <li><form action="/logout" method="post">@csrf<button class="button" type="submit">Déconnexion</button></form></li>
                        </ul>
                    </div>
                @else
                    <div id="menu_profil_content">
                        <p id="user_name"><a href="/login">Se connecter</a></p>
                        <img id="user_icon" src="/images/user_icon.png" alt="user">
                    </div>
                @endif
            </div>

            <div id="burger_menu">
                <div id="burger_bar"></div>
                <div id="burger_bar"></div>
                <div id="burger_bar"></div>
                <ul id="submenu_burger">
                    <li><a href="/">Acceuil</a></li>
                    <li><a href="#">Événements</a></li>
                    <li><a href="#">Boite à idées</a></li>
                    <li><a href="#">Boutique</a></li>
                    <li><a href="#">Mon profil</a></li>
                    <li><a href="#">Mes commandes</a></li>
                    <li><a href="#">Mes notifs</a></li>
                </ul>
            </div>
        </div>
        @yield('header')
    </header>
    @yield('content')
    <footer>
            <div id="content">
                <div id="logo-bde">
                    <img src="images/Logo_bde.png" alt="Logo">
                </div>
                <div id="links">
                    <p>Liens rapides</p>
                    <nav>
                        <li><a href="#">Boutique</a></li>
                        <li><a href="#">Evènements</a></li>
                        <li><a href="#">Idées</a></li>
                        <li><a href="#">Mon profil</a></li>
                    </nav>
                </div>
    
                <div id="contact">
                    <p>Contact</p>
                    <form method="post" action="">
                        <input type="text" placeholder="Nom">
                        <input type="email" placeholder="E-mail">
                        <textarea placeholder="Message..." rows="4"></textarea>
                        <button type="submit">Envoyer</button>
                    </form>
                    
                </div>
            </div>
            
            
            <div id="social">
                <p>Retrouvez-nous sur :</p>
                <div id="social-logos">
                    <a id="facebook" href="#"><img src="images/facebook.png" alt="Facebook"></a>
                    <a id="twitter" href="#"><img src="images/twitter.png" alt="Twitter"></a>
                    <a id="youtube" href="#"><img src="images/youtube.png" alt="YouTube"></a>
                </div>
            </div>
    
            <div id="legal">
                <span><a href="#">Mentions légales</a></span>
                <span>Crédits</span>
                <span>&copy; Groupe3 2019</span>
            </div>
        </footer>
</body>
</html>