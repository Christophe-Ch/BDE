@extends('layout/duo')

@section('title', 'CONNEXION')

@section('content_form')
<form action="/login" method="post">
    {{csrf_field()}}
    <p class="title_input_left">E-mail</p>
    <input class="input_left" type="text" name="email"><br>
    @if ($errors->has('email'))
        <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif

    <p class="title_input_left">Mot de passe</p>
    <input class="input_left" type="password" name="password"><br>
    @if ($errors->has('password'))
        <span class="help-block">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
    @endif

    <input class="btn_left" type="submit" value="Se connecter">
</form>
<p>Pas encore inscit ? <a href="/register">S'inscrire</a></p>
@endsection