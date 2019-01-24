@extends('layout.base')

@section('stylesheets')
    <link rel="stylesheet" href="/css/user.css">
@endsection

@section('header')
    <h1 class="header_title">PROFIL</h1>
@endsection

@section('content')
<div class="profil">
    <div id="profil_avatar">
        <img id="profil_img" src="/storage/{{Auth::user()->photo}}" alt="Profil image">
        <button class="button blue" id="profil_img_change">Modifier</button>
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

<div class="profil_modal" id="profil_modal">
    <div class="profil_content" id="profil_content">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="/profil/modifier/{{Auth::user()->id}}/photo" method="post" enctype="multipart/form-data">
            @csrf
            <div class="profil_warp">
                <h3 class="profil_title">Nouvelle photo :</h3>
                <input class="profil_desc_input" type="file" name="photo" value="/storage/{{Auth::user()->photo}}">
            </div>
            <input class="button" type="submit" value="Modifier">
        </form>
    </div>
</div>
@endsection