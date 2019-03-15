@extends('layout.duo')

@section('css')
    <link rel="stylesheet" href="/css/ideas.css">
@endsection

@section('title')
    Modifier le profil
@endsection

@section('content_form')
    @if ($errors->any())
        <div id="informations">
                @foreach ($errors->all() as $error)
                    <a id="information">{{ $error }}</a>
                @endforeach
        </div>
    @endif
    <form id="form-idea" action="/users/{{ $user->id }}" method="post">
        @csrf
        @method('put')
        
        <label for="name" class="title_input_left">Nom :</label>
        <input class="input_left" type="text" name="name" value="{{ $user->name }}">

        <label for="prenom" class="title_input_left">Prénom :</label>
        <input class="input_left" type="text" name="prenom" value="{{ $user->prenom }}">

        <label for="email" class="title_input_left">E-mail :</label>
        <input class="input_left" type="text" name="email" value="{{ $user->email }}">
        
        <input id="form-submit" class="button btn_left" type="submit" value="Valider">
    </form>
@endsection
