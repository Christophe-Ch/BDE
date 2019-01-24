@extends('layout/base')

@section('stylesheets')
    <link rel="stylesheet" href="/css/user.css">
@endsection

@section('header')
    <h1 class="header_title">PROFIL</h1>
@endsection

@section('content')
<div class="profil">
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
        <form action="/profil/modifier/{{Auth::user()->id}}/photo" method="post" enctype="multipart/form-data">
            @csrf
            <div class="profil_warp">
                <h3 class="profil_title">Avatar :</h3>
                <input class="profil_desc_input" type="file" name="photo" value="/storage/{{Auth::user()->photo}}">
            </div>
            <input class="button" type="submit" value="Modifier">
        </form>
    </div>
</div>
@endsection