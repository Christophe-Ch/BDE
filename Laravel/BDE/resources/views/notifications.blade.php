@extends('layout/base')

@section('stylesheets')
<link rel="stylesheet" href="/css/notification.css">
@endsection

@section('header')
<div class="notifications-container">
    @foreach ($notifications as $notification)
        @component('layout.component.notification')
            @slot('date')
                {{ $notification->date }}
            @endslot
            @slot('title')
                {{ $notification->titre }}
            @endslot
            @slot('content')
                {{ $notification->message }}
            @endslot
            @slot('linkUrl')
                {{ $notification->url }}
            @endslot
            @slot('id')
                {{ $notification->id }}
            @endslot
        @endcomponent
    @endforeach
</div>
@endsection