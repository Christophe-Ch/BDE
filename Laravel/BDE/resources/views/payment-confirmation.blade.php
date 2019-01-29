@extends('layout.base')

@section('stylesheets')
    <link rel="stylesheet" href="/css/payment.css">
@endsection

@section('header')

    <div id="confirmation-container">
        <h1>Confirmation</h1>
        <h2>Etes-vous sûr de vouloir effectuer le payement ?</h2>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="/payment/cash">
            <div>
                <input type="checkbox" name="condition">
                <label for="condition">J'accepte les <a target="blank" href="/legal-notice">conditions de vente</a></label>
            </div>
            
            <input class="hovered" type="submit" value="Valider">
        </form> 
    </div>
    
@endsection