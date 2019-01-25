@extends('layout/duo')

@section('title', 'INSCRIPTION')

@section('img')
<img id="img_right" src="/images/Logo_bde2.png" alt="Logo">
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
<form action="/register" method="post">
    {{csrf_field()}}
    <p class="title_input_left">Nom</p>
    <input class="input_left" type="text" name="name"><br>

    <p class="title_input_left">Prenom</p>
    <input class="input_left" type="text" name="prenom"><br>

    <p class="title_input_left">E-mail</p>
    <input class="input_left" type="email" name="email"><br>

    <p class="title_input_left">Mot de passe</p>
    <input class="input_left" type="password" name="password"><br>

    <p class="title_input_left">Confirmation mot de passe</p>
    <input class="input_left" type="password" name="password_confirmation"><br>

    <div id="condition">
        <input type="checkbox" name="checkbox">
        <p class="title_condition_left">J'accepte les conditions de règlements</p>
    </div><br>

    <input class="btn_left" type="submit" value="S'inscrire">
</form>
<p>Déja inscit ? <a href="/login">Se connecter</a></p>
@endsection