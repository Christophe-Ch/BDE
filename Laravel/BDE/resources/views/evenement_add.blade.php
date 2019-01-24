@extends('layout.duo')

@section('title')
    Ajout d'un Evenement
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
<form action="{{ route('event.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <p class="title_input_left">Nom</p>
    <input class="input_left" type="text" name="nom" value="{{ old('nom') }}"><br>

    <p class="title_input_left">Description</p>
    <input class="input_left" type="text" name="description" value="{{ old('description') }}"><br>

    <p class="title_input_left">Date</p>
    <input class="input_left" type="date" name="date" value="{{ old('date') }}"><br>

    <p class="title_input_left">Prix</p>
    <input class="input_left" type="text" name="prix" value="{{ old('prix') }}"><br>

    <p class="title_input_left">Photo</p>
    <input class="input_left" type="file" name="photo" value="{{ old('photo') }}"><br>

    <input class="btn_left" type="submit" value="Créer">
</form>
@endsection