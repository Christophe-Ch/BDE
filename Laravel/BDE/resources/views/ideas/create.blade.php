@extends('layout.duo')

@section('css')
    <link rel="stylesheet" href="/css/ideas.css">
@endsection

@section('title')
    Créer une idée
@endsection

@section('content_form')
    <form id="form-create-idea" action="/ideas" method="post">
        @csrf
        <div class="row-form">
        <label for="title">Titre :</label>
        <input id="form-title" type="text" name="title" required>
        </div>
        <div class="row-form">
        <label for="description">Description :</label>
        <textarea id="form-description" name="description" maxlength="255">
        </textarea>
        </div>
        <input id="form-submit" class="button" type="submit" value="créer">
    </form>
@endsection