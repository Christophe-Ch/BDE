@extends('layout.base')

@section('stylesheets')
    <link rel="stylesheet" href="/css/event.css">
@endsection

@section('header')
    <h1 class="header_title">EVENEMENT</h1>
@endsection

@section('content')
    @component('layout.component.search-bar')
        @slot('placeholder')
            Rechercher un produit...
        @endslot
    @endcomponent
    <div class="evenement_list">
        @foreach ($events as $event)
        <div class="evenement_element">
            @component('layout.component.list-element')
                @slot('url')
                    /images/CESI_Corporate_Ecole_Ingenieurs.jpg
                @endslot
                @slot('alt')
                    Photo event
                @endslot
                @slot('title')<a class="title_event" href="/event/{{$event->id}}">{{$event->nom}}</a>@endslot
                @slot('description'){{$event->description}}@endslot
                @slot('actions')
                    <form action="/event/register/{{$event->id}}" method="post">@csrf<button class="button" type="submit">S'inscrire</button></form>
                    <p>{{substr($event->date, 0, 10)}} | {{$event->prix}} €</p>
                @endslot
            @endcomponent
        </div>
        @endforeach
    </div>

    @isset($eventSelec)
        <div class="modal" id="modal" style="display: block">
                <div class="modal-content">
                    <div class="modal-header">
                        <button id="closeCross" type="button"><img src="/images/fermeture.png" alt="X"></button>
                        <img class="img_modal" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRdawC4Gw3WcN02RDozJqfoprI7pfhG74FfitNGRKHkxha04qoxQg" alt="Photo">
                        <div class="content">
                            <h2 id="modal_title">{{$eventSelec->nom}}</h2>
                            <div class="infos">
                                <p>{{substr($eventSelec->date, 0, 10)}}</p>
                                <p>{{$eventSelec->prix}} €</p>
                            </div>
                            <p>{{$eventSelec->description}}</p>
                            <div class="actions">
                                <form action="/event/register/{{$eventSelec->id}}" method="post">@csrf<button class="button" type="submit">S'inscrire</button></form>
                                <p>{{$nbUser}} participants</p>
                            </div>
                        </div>
                    </div>
                    <div class="galerie_photo">
                        <div class="photo">
                            <p>+</p>
                        </div>
                        @foreach ($photos as $photo)
                            <img class="photo" src="{{$photo->url}}" alt="Photo">
                        @endforeach
                    </div>
                </div>
        </div>
    @endisset
    
@endsection