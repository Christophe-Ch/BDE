@extends('layout.base')

@section('stylesheets')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="/css/administration.css">
    <link rel="stylesheet" type="text/css" href="/css/ideas.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
@endsection

@section('header')
    <div class="header_title">
        <h1>Administration</h1>
    </div>
@endsection

@section('content')
    <span id="api_token" style="visibility: hidden">{{ Auth::user()->api_token }}</span>
    <div class="panel-container">
        <div class="panel">
            <h1>Utilisateurs</h1>
    
            <table id="users" class="display nowrap">
                <thead>
                    <tr>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Centre</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>

        <div class="panel">
            <h1>Articles</h1>
    
            <table id="articles" class="display nowrap">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Prix</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>

        <div class="panel">
            <h1>Evènements</h1>
    
            <table id="events" class="display nowrap">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Prix</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>

        <div class="panel">
            <h1>Idées</h1>
    
            <table id="ideas" class="display nowrap">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Auteur</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <script type="text/javascript" charset="utf8" src="/js/administration.js"></script>
@endsection
