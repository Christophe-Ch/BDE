@extends('layout.base')

@section('header')
<div id="text_home">
    <h1 id="title_home">It's not too late to participate !</h1>
    <p id="description_home">Venez découvrir tous les éléments proposés par le BDE ...</p>
</div>
@if (!Auth::check())
    <div id="auth_home">
        <a href="/login"><input class="button" type="button" value="Se connecter"></a>
        <a href="/register"><input id="input_home" type="button" value="S'inscrire"></a>
    </div>
@endif

<div id="img_home">
    <img src="images/Logo_bde2.png" alt="Logo">
</div>
@endsection