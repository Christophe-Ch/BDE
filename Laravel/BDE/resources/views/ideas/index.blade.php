@extends('layout.base')

@section('stylesheets')
<link rel="stylesheet" href="/css/search-bar.css">
<link rel="stylesheet" href="/css/list-element.css">
<link rel="stylesheet" href="/css/ideas.css">
@endsection

@section('header')
    <h1 class="header_title">Idees</h1>
@endsection

@section('content')

@component('layout.component.search-bar')
    @slot('placeholder')
    Rechercher une idée...
    @endslot
@endcomponent

@foreach ($ideas as $idea)
    @component('layout.component.list-element')
        @slot('url')
            images/ImageNotFound.png
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
            <a id="plan_button" href="#"><input id="input_home_color" class="button" type="button" value="Planifier"></a>
            <form id="actions" action="/votes/{{ $idea->id }}" method="post">
                @if(\App\Vote::select('id')->where('user_id', Auth::user()->id)->where('idee_id', $idea->id)->first() != null)
                    @method('DELETE')
                @endif
                @csrf
                <a id="vote_button">
                {{ App\Vote::where('idee_id', $idea->id)->count() }}
                <input id="vote_button" type="image" src="images/icons8-heart-outline-52.png" alt="heart"></a>
            </form>
            @endif
        @endslot
    @endcomponent
@endforeach
@endsection