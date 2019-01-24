@extends('layout.base')

@section('stylesheets')
    <link rel="stylesheet" href="/css/search-bar.css">
    <link rel="stylesheet" href="/css/list-element.css">
    <link rel="stylesheet" href="/css/articles/index.css">
    <link rel="stylesheet" href="/css/top-article.css">
@endsection

@section('header')
    <div class="carousel-container" id="top-article0">
        @component('layout.component.top-article')
            @slot('name')
                {{$top_article0->nom}}
            @endslot

            @slot('description')
                {{$top_article0->description}}
            @endslot

            @slot('price')
                {{$top_article0->prix}}
            @endslot

            @slot('id')
                {{$top_article0->id}}
            @endslot

            @slot('src')
                /images/bonnet.png
            @endslot

            @slot('alt')
                Top article 1
            @endslot
        @endcomponent
        <div class="circle-container">
            <div class="circle" id="filled"></div>
            <div class="circle"></div>
            <div class="circle"></div>
        </div>
    </div>
    <div class="carousel-container" id="top-article1">
        @component('layout.component.top-article')
            @slot('name')
                {{$top_article1->nom}}
            @endslot

            @slot('description')
                {{$top_article1->description}}
            @endslot

            @slot('price')
                {{$top_article1->prix}}
            @endslot

            @slot('id')
                {{$top_article1->id}}
            @endslot

            @slot('src')
                /images/pull.png
            @endslot

            @slot('alt')
                Top article 2
            @endslot
        @endcomponent
        <div class="circle-container">
            <div class="circle"></div>
            <div class="circle" id="filled"></div>
            <div class="circle"></div>
        </div>
    </div>
    <div class="carousel-container" id="top-article2">
        @component('layout.component.top-article')
            @slot('name')
                {{$top_article2->nom}}
            @endslot

            @slot('description')
                {{$top_article2->description}}
            @endslot

            @slot('price')
                {{$top_article2->prix}}
            @endslot

            @slot('id')
                {{$top_article2->id}}
            @endslot

            @slot('src')
                /images/bonnet.png
            @endslot

            @slot('alt')
                Top article 3
            @endslot
        @endcomponent
        <div class="circle-container">
            <div class="circle"></div>
            <div class="circle"></div>
            <div class="circle" id="filled"></div>
        </div>
    </div>
@endsection

@section('content')
    @component('layout.component.search-bar')
        @slot('placeholder')
            Rechercher un produit...
        @endslot
    @endcomponent

    <div id="list-component-container">
        @foreach ($articles as $article)
            <div id="article-element">
                @component('layout.component.list-element')
                    @slot('url')
                        {{$article->photo}}
                    @endslot

                    @slot('alt')
                        {{$article->nom}}
                    @endslot

                    @slot('title')
                        {{$article->nom}}
                    @endslot

                    @slot('description')
                        {{$article->description}}
                    @endslot

                    @slot('actions')
                        @if(App\Achat::where('article_id', '=', $article->id)->where('user_id', '=', Auth::user()->id)->count())
                            <button class="button is-valid">
                                <img src="/images/check.png" alt="Article commandé">
                            </button>
                        @else
                            <form method="POST" action="/purchase">
                                @csrf
                                <button class="button" type="submit">Commander</button>
                            </form>
                        @endif
                        
                        <div id="price">
                            {{$article->prix}}€
                        </div>
                    @endslot
                @endcomponent
            </div>
        @endforeach
    </div>
@endsection

<script src="/js/articles.js"></script>
