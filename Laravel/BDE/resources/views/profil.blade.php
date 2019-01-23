@extends('layout/base')

@section('stylesheets')
    <link rel="stylesheet" href="/css/user.css">
@endsection

@section('header')
    <h1 class="header_title">PROFIL</h1>
@endsection

@section('content')
<div class="profil">
    <div id="profil_avatar">
        <img id="profil_img" src="/images/{{Auth::user()->photo}}" alt="Profil image">
        <p id="profil_img_change"><a href="/profil/modifier/photo">Modifier</a></p>
    </div>

    <div id="profil_content">
        <div class="profil_warp">
            <h3 class="profil_title">Nom :</h3>
            <p class="profil_desc">{{Auth::user()->name}}</p>
        </div>
        <div class="profil_warp">
            <h3 class="profil_title">Prenom :</h3>
            <p class="profil_desc">{{Auth::user()->prenom}}</p>
        </div>
        <div class="profil_warp">
            <h3 class="profil_title">E-mail :</h3>
            <p class="profil_desc">{{Auth::user()->email}}</p>
        </div>
        <div class="profil_warp">
            <h3 class="profil_title">Centre :</h3>
            <p class="profil_desc">{{Auth::user()->centre['nom']}}</p>
        </div>
        <a href="/profil/modifier/{{Auth::user()->id}}"><button class="button" type="button">Modifier</button></a>
    </div>
</div>
@endsection