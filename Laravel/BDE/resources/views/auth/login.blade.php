@extends('layout/duo')

@section('title', 'CONNEXION')

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
<form action="/login" method="post">
    @csrf
    <p class="title_input_left">E-mail</p>
    <input class="input_left" type="email" name="email" value="{{ old('email') }}"><br>

    <p class="title_input_left">Mot de passe</p>
    <input class="input_left" type="password" name="password"><br>

    <input class="btn_left" type="submit" value="Se connecter">
</form>
<p>Pas encore inscit ? <a href="/register">S'inscrire</a></p>
@endsection