@extends('layout.base')

@section('stylesheets')
<link rel="stylesheet" href="/css/search-bar.css">
<link rel="stylesheet" href="/css/list-element.css">
<link rel="stylesheet" href="/css/ideas.css">
@endsection

@section('header')
    <span class="header_title">
        <h1>Idees</h1>
    </span>
@endsection

@section('content')
@component('layout.component.search-bar')
    @slot('placeholder')
    Rechercher une idée...
    @endslot
@endcomponent

<span id="create_idea">
    <a href="/ideas/create" >+ créer une idée</a>
</span>


@foreach ($ideas as $idea)
    @component('layout.component.list-element')
        @slot('url')
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
            @if (auth::check())

            @if(auth::user()->statut_id == 2)
            <a id="plan_button" href="#"><input id="input_home_color" class="button" type="button" value="Planifier"></a>
            @else
            <a href="#"></a>
            @endif

            @if (auth::user()->id == $idea->user_id)
            <a id="plan_button" href="/ideas/{{ $idea->id }}/edit"><input id="input_home_color" class="button blue" type="button" value="modifier"></a>
            <form action="/ideas/{{ $idea->id }}" method="post">
                @csrf
                @method('DELETE')
                <input class="button red" type="submit" value="Supprimer" >
            </form>

            @endif

            <div>
                <form id="form" action="/votes/{{ $idea->id }}" method="post">
                    @csrf
                    <label id="vote_label"  for="vote">{{ $votes->where('idee_id', $idea->id)->count() }}</label>
                    @if($votes->where('user_id', Auth::user()->id)->where('idee_id', $idea->id)->first() != null)
                        @method('DELETE')
                        <input id="vote_button" type="image" src="/images/icons8-heart-outline-52_like.png" alt="heart">
                    @else
                        <input id="vote_button" type="image" src="/images/icons8-heart-outline-52.png" alt="heart">
                    @endif

                </form>
            </div>
            @endif
        @endslot
    @endcomponent
@endforeach
@endsection
