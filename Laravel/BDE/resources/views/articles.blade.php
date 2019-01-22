@extends('layout.base')

@section('stylesheets')
    /css/search-bar.css
@endsection

@section('content')
    @component('layout.component.search-bar')
    @slot('placeholder')
        Rechercher un produit...
    @endslot
@endcomponent
@endsection
