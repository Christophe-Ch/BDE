@extends('layout.base')


@section('stylesheets')
    <link rel="stylesheet" href="/css/payment.css">
@endsection

@section('header')
    <div id="purchase-container">
        <div id="checked">
            <img src="/images/checked.png" alt="Checked">
            <h1>Votre commande a bien été enregistrée</h1>
        </div>
        <p>Vous allez recevoir la date et le lieu de la transaction par mail.</p>
        <a href="/articles" class="hovered">Retourner à la boutique</a>
    </div>
@endsection