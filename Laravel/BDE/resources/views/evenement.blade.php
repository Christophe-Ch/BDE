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
    <div class="evenement_add">
        <img src="/images/add.png" alt="+">
        <a href="{{ route('event.create') }}"><h1>Ajout d'un événement</h1></a>
    </div>
    <div class="evenement_list">
        @foreach ($events as $event)
        <div class="evenement_element">
            @component('layout.component.list-element')
                @slot('url')
                    /storage/{{$event->photo}}
                @endslot
                @slot('alt')
                    Photo event
                @endslot
                @slot('title')<a class="title_event" href="{{ route('event.show',['event' => $event->id])}}">{{$event->nom}}</a>@endslot
                @slot('description'){{$event->description}}@endslot
                @slot('actions')
                    <form action="/event/register/{{$event->id}}" method="post">@csrf<button class="button" type="submit">S'inscrire</button></form>
                    @if(Auth::user() && Auth::user()->statut_id == 2)
                        <a href="{{ route('event.edit',['event' => $event->id]) }}"><button class="button blue btn_admin" type="submit">Modifier</button></a>
                        <form action="{{ route('event.destroy',['event' => $event->id]) }}" method="post">@method('delete')@csrf<button class="button red btn_admin" type="submit">Supprimer</button></form>
                    @endif
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
                        <img class="img_modal" src="/storage/{{$event->photo}}" alt="Photo">
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
                    <form id="ajout_photo" action="/photo" method="post">
                        <input type="file" name="photo">
                        <button type="submit" class="button blue">Ajouter</button>
                    </form>
                    
                    <div class="galerie_photo">
                        @foreach ($photos as $photo)
                            <img class="photo" src="{{$photo->url}}" alt="Photo">
                        @endforeach
                    </div>
                </div>
        </div>
    @endisset
    
@endsection