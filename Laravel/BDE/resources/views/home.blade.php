@extends('layout/base')

@section('content')
<div id="text_home">
    <h1 id="title_home">It's not too late to participate !</h1>
    <p id="description_home">Venez découvrir tous les éléments proposés par le BDE ...</p>
</div>
@if (!Auth::check())
    <div id="auth_home">
        <input id="input_home_color" type="button" value="Se connecter">
        <input id="input_home" type="button" value="S'inscrire">
    </div>
@endif
<div id="img_home">
    <img src="images/Logo_bde2.png" alt="Logo">
</div>
@endsection