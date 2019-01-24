@extends('layout.duo')

@section('css')
<link rel="stylesheet" href="/css/ideas.css">
@endsection

@section('title')
    Modifier une idée
@endsection

@section('content_form')
    <form id="form-idea" action="/ideas/{{ $edit->id }}" method="post">
        @csrf
        @method('PUT')
        <label for="title" class="title_input_left">Titre :</label>
        <input class="input_left" type="text" name="title" value="{{ $edit->nom }}" required>
        <label for="description" class="title_input_left">Description :</label>
        <textarea class="input_left" name="description" maxlength="255">
            </textarea>
        <input id="form-submit" class="button" type="submit">
    </form>
@endsection