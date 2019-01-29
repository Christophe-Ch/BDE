@extends('layout.duo')

@section('stylesheets')
    <link rel="stylesheet" href="/css/articles/form.css">
@endsection

@section('title')
    Ajout d'un article
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

    <form action="/articles" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name" class="title_input_left">Nom</label>
        <input class="input_left" type="text" name="name" value="{{old('name')}}">

        <div id="little-input-container">
            <div class="little-input">
                <label for="price" class="title_input_left">Prix</label>
                <input class="input_left"type="text" name="price" value="{{old('price')}}">
            </div>
            <div class="little-input">
                <label for="stock" class="title_input_left">Stock</label>
                <input class="input_left"type="text" name="stock" value="{{old('stock')}}">
            </div>
        </div>

        <label for="category" class="title_input_left">Catégorie</label>
        <div id="select" class="input_left">
            <select name="category">
                @foreach ($categories as $category)
                    <option class="input_left" value="{{$category->id}}">{{$category->nom}}</option>
                @endforeach
            </select>
        </div>
        

        <label for="description" class="title_input_left">Description</label>
        <textarea class="input_left" id="description-input" name="description" value="{{old('description')}}"></textarea>

        <label for="pic" class="title_input_left">Photo</label>
        <input class="input_left" type="file" name="pic" value="{{ old('pic') }}"><br>

        <div>
            <input class="btn_left" type="submit" value="Ajouter">
        </div>
    </form>
    
@endsection

@section('img')
    <img id="img_right" src="/images/Logo_bde2.png" alt="Logo">
@endsection