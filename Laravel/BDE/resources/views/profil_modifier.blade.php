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
        <img id="profil_img" src="/storage/{{Auth::user()->photo}}" alt="Profil image">
        <p id="profil_img_change"><a href="/profil/modifier/{{Auth::user()->id}}/photo">Modifier</a></p>
    </div>

    <div id="profil_content">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/profil/modifier/{{Auth::user()->id}}" method="post">
            @csrf
            <div class="profil_warp">
                <h3 class="profil_title">Nom :</h3>
                <input class="profil_desc_input" type="text" name="name" value="{{Auth::user()->name}}">
            </div>
            <div class="profil_warp">
                <h3 class="profil_title">Prenom :</h3>
                <input class="profil_desc_input" type="text" name="prenom" value="{{Auth::user()->prenom}}">
            </div>
            <div class="profil_warp">
                <h3 class="profil_title">E-mail :</h3>
                <input class="profil_desc_input" type="email" name="email" value="{{Auth::user()->email}}">
            </div>
            <div class="profil_warp">
                <h3 class="profil_title">Centre :</h3>
                <select name="centre" class="profil_desc_input" value="{{Auth::user()->centre}}">
                    @foreach($centres as $centre)
                        <option value="{{$centre->id}}">{{$centre->nom}}</option>
                    @endforeach
                </select>
            </div>
            <input class="button" type="submit" value="Modifier">
        </form>
    </div>
</div>
@endsection