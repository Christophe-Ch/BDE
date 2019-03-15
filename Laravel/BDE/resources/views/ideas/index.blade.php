@extends('layout.base')

@section('stylesheets')
<link rel="stylesheet" href="/css/search-bar.css">
<link rel="stylesheet" href="/css/list-element.css">
<link rel="stylesheet" href="/css/ideas.css">
@endsection

@section('header')
    <div class="header_title">
        <h1>Idees</h1>
    </div>
@endsection

@section('content')
@component('layout.component.search-bar')
@slot('url')
    /ideas/search
    @endslot
    @slot('placeholder')
    Rechercher une idée...
    @endslot
@endcomponent

<div id="create_idea">
    <a href="/ideas/create" >+ créer une idée</a>
</div>


@foreach ($ideas as $idea)
    @component('layout.component.list-element')
        @slot('url')
        #
        @endslot
        @slot('alt')
            {{ $idea->id }}
        @endslot
        @slot('title')
            {{ $idea->nom }}
        @endslot
        @slot('description')
            {{ $idea->description }}
        @endslot
        @slot('actions')
            @auth

            @if(auth::user()->statut_id == 2)
            <a id="plan_button" class="button_tel" href="{{ route('event.create', ['idee' => $idea->id]) }}"><input id="input_home_color" class="button" type="button" value="Planifier"></a>
            @else
            <a href="#"></a>
            @endif

            @if (auth::user()->id == $idea->user_id)
            <form id="plan_button" action="/ideas/{{ $idea->id }}/edit" method="GET">@csrf<input id="input_home_color" class="button blue" type="submit" value="Modifier"></form>
            <form action="/ideas/{{ $idea->id }}" method="post">
                @csrf
                @method('DELETE')
                <input class="button red button_tel" type="submit" value="Supprimer" >
            </form>

            @endif

            <div>
                <form id="form" action="/votes/{{ $idea->id }}" method="post">
                    @csrf
                    @if($votes->where('user_id', Auth::user()->id)->where('idee_id', $idea->id)->first() != null)
                        @method('DELETE')
                <input id="vote_{{ $idea->id }}" class="vote_button_tel" type="image" src="/images/icons8-heart-outline-52_like.png" alt="heart">
                    @else
                        <input id="vote_{{$idea->id}}" class="vote_button_tel" type="image" src="/images/icons8-heart-outline-52.png" alt="heart">
                    @endif
                    <label id="vote_label"  for="vote_{{$idea->id}}">{{ $votes->where('idee_id', $idea->id)->count() }}</label>

                </form>
            </div>
            @endauth
        @endslot
    @endcomponent
@endforeach
@endsection
