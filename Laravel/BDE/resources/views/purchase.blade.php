@extends('layout.base')

@section('stylesheets')
    <link rel="stylesheet" href="/css/purchase-element.css">
    <link rel="stylesheet" href="/css/purchase.css">
@endsection

@section('header')
    
        @if (count($articles))
            <div id="purchase-element-container">
                @foreach ($articles as $index => $article)
                    @component('layout.component.purchase-element')
                        @slot('src')
                            /storage/{{$article->photo}}
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
            <div id="purchase-container">
                <div id="price-container">
                    <p>Total : <span>{{$price}}€</span></p>
                </div>
    
                <div id="payment">
                    <span>Payer par : </span>
                    <a href="/payment/cash" class="button">Espèces</a>
                    <a href="/payment/paypal" class="button">Paypal</a>
                </div>
            </div>
        @else
            <h2>Vous n'avez commandé aucun article.</h2>
        @endif
    
@endsection
