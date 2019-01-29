@extends('layout.duo')

@section('title', 'Mofifcation du profil')

@section('stylesheets')
    <link rel="stylesheet" href="/css/user.css">
@endsection

@section('img')
    <div id="modif_avatar">
        <img id="profil_img" src="/storage/{{Auth::user()->photo}}" alt="Profil image">
        <button class="button blue" id="profil_img_change">Modifier</button>
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
                        <input class="profil_desc_input" type="file" name="photo">
                    </div>
                    <input class="button" type="submit" value="Modifier">
                </form>
            </div>
        </div>
@endsection

@section('content_form')
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
    <h3 class="title_input_left">Nom :</h3>
    <input class="input_left" type="text" name="name" value="{{Auth::user()->name}}"><br>

    <h3 class="title_input_left">Prenom :</h3>
    <input class="input_left" type="text" name="prenom" value="{{Auth::user()->prenom}}"><br>

    <h3 class="title_input_left">E-mail :</h3>
    <input class="input_left" type="email" name="email" value="{{Auth::user()->email}}"><br>

    <input class="button" type="submit" value="Modifier">
</form>
@endsection