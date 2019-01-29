@extends('layout.base')

@section('stylesheets')
    <link rel="stylesheet" href="/css/search-bar.css">
    <link rel="stylesheet" href="/css/list-element.css">
    <link rel="stylesheet" href="/css/articles/index.css">
    <link rel="stylesheet" href="/css/top-article.css">
@endsection

@section('header')
    <h1>Boutique</h1>
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
                {{$top_article0->photo}}
            @endslot

            @slot('alt')
                Top article 1
            @endslot
        @endcomponent
        <div class="circle-container">
            <div class="circle filled"></div>
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
                {{$top_article0->photo}}
            @endslot

            @slot('alt')
                Top article 2
            @endslot
        @endcomponent
        <div class="circle-container">
            <div class="circle"></div>
            <div class="circle filled"></div>
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
                {{$top_article0->photo}}
            @endslot

            @slot('alt')
                Top article 3
            @endslot
        @endcomponent
        <div class="circle-container">
            <div class="circle"></div>
            <div class="circle"></div>
            <div class="circle filled"></div>
        </div>
    </div>
@endsection

@section('content')
    @component('layout.component.search-bar')
        @slot('url')
            /articles/search
        @endslot
        @slot('placeholder')
            Rechercher un produit...
        @endslot
    @endcomponent

    

    <div id="filter">
        <form id="filter-form" action="/articles" method="GET">
            <select name="filter" onchange="document.forms['filter-form'].submit()">
                <option value="chose">- Choisir -</option>
                <option value="price-asc">Prix croissant</option>
                <option value="price-desc">Prix décroissant</option>
                @foreach (App\Categorie::all() as $categorie)
                    <option value="{{$categorie->nom}}">{{$categorie->nom}}</option>
                @endforeach
                <option value="undefined">Aucun</option>
            </select>
        </form>
        <span>Trier par :</span>
    </div>
    
    <div id="add">
        <img src="/images/add.png" alt="Add">
        <a href="/articles/create">Ajouter un produit</a>
    </div>

    <div id="list-component-container">
        @foreach ($articles as $article)
            <div class="article-element">
                @component('layout.component.list-element')
                    @slot('url')
                        /storage/{{$article->photo}}
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
                        @if(Auth::user() && App\Achat::where('article_id', '=', $article->id)->where('user_id', '=', Auth::user()->id)->count())
                            <button class="button is-valid">
                                <img src="/images/check.png" alt="Article commandé">
                            </button>
                        @else
                            <form class="purchase" method="POST" action="/purchase">
                                @csrf
                                <button class="button" type="submit" {{$article->stock <= 0 ? 'disabled' : ''}}>Commander</button>
                                
                                <input type="hidden" name="id" value="{{$article->id}}">
                            </form>
                        @endif

                        @if (Auth::user() && Auth::user()->statut_id == 2)
                        <div class="edit">
                            <a class="button" href="/articles/{{$article->id}}/edit">Modifier</a>
                        </div>
                            

                        <form class="delete" method="POST" action="/articles/{{$article->id}}">
                            @method('DELETE')
                                @csrf
                                <button class="button" type="submit">Supprimer</button>
                            </form>
                        @endif


                        
                        <div class="price">
                            {{$article->prix}}€
                        </div>
                    @endslot
                @endcomponent
            </div>
        @endforeach
    </div>
@endsection

<script src="/js/articles.js"></script>
