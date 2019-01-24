@extends('layout.duo')

@section('title')
    <h1>Modifier une idée</h1>
@endsection

@section('content_form')
    <form action="/ideas/{{ $edit->id }}" method="post">
        @csrf
        @method('PUT')
        <label for="title">Titre :</label>
        <input id="form-title" type="text" name="title" value="{{ $edit->nom }}" required>
        <label for="description">Description :</label>
        <input id="form-description" type="text" name="description" value="{{ $edit->description }}" required>
        <input id="form-submit" type="submit">
    </form>
@endsection