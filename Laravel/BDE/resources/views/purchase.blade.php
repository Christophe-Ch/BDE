@extends('layout.base')

@section('stylesheets')
    <link rel="stylesheet" href="/css/purchase-element.css">
    <link rel="stylesheet" href="/css/purchase.css">
@endsection

@section('header')
    <div id="purchase-element-container">
        @foreach ($articles as $index => $article)
            @component('layout.component.purchase-element')
                @slot('src')
                    {{-- /storage/{{$article->photo}} --}}
                    /storage/Bonnet.png
                @endslot

                @slot('alt')
                    {{$article->nom}}
                @endslot

                @slot('title')
                    {{$article->nom}}
                @endslot

                @slot('quantity')
                    {{$achats[$index]->quantite}}
                @endslot

                @slot('price')
                    {{$article->prix}}
                @endslot

                @slot('id')
                    {{$achats[$index]->id}}
                @endslot
            @endcomponent
        @endforeach
        
    </div>
    
@endsection
