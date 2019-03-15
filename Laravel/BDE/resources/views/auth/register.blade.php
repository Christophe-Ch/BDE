@extends('layout/duo')

@section('title', 'INSCRIPTION')

@section('stylesheets')
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
@endsection

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
    <input class="input_left" type="text" name="name" value="{{ old('name') }}" required><br>

    <p class="title_input_left">Prenom</p>
    <input class="input_left" type="text" name="prenom" value="{{ old('prenom') }}" required><br>

    <p class="title_input_left">E-mail</p>
    <input class="input_left" type="email" name="email" value="{{ old('email') }}" required><br>

    <p class="title_input_left">Mot de passe</p>
    <input class="input_left" type="password" name="password" value="{{ old('password') }}" required><br>

    <p class="title_input_left">Confirmation mot de passe</p>
    <input class="input_left" type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" required><br>

    <div id="condition">
        <input type="checkbox" name="checkbox" required>
        <p class="title_condition_left">J'accepte les <a href="#">conditions de règlements</a></p>
    </div><br>

    <input class="btn_left" type="submit" value="S'inscrire" disabled>
</form>
<p>Déja inscit ? <a href="/login">Se connecter</a></p>
<script type="text/javascript" charset="utf8" src="/js/validation.js"></script>
@endsection