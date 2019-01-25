@extends('layout.base')

@section('stylesheets')
    <link rel="stylesheet" href="/css/purchase-element.css">
    <link rel="stylesheet" href="/css/purchase.css">
@endsection

@section('header')
    <div id="purchase-element-container">
        @component('layout.component.purchase-element')
            @slot('src')
                /images/bonnet.png
            @endslot

            @slot('alt')
                Bonnet
            @endslot

            @slot('title')
                Bonnet d'hiver
            @endslot

            @slot('stock')
                1
            @endslot

            @slot('price')
                20
            @endslot

            @slot('id')
                1
            @endslot
        @endcomponent
    </div>
    
@endsection
