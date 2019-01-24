@extends('layout.duo')

@section('css')
    <link rel="stylesheet" href="/css/ideas.css">
@endsection

@section('title')
    Créer une idée
@endsection

@section('content_form')
    <form id="form-idea" action="/ideas" method="post">
        @csrf
        <label for="title" class="title_input_left">Titre :</label>
        <input class="input_left" type="text" name="title" required>
        <label for="description" id="description-form" class="title_input_left">Description :</label>
        <textarea class="input_left" name="description" maxlength="255">
        </textarea>
        <input id="form-submit" class="button" type="submit" value="créer">
    </form>
@endsection