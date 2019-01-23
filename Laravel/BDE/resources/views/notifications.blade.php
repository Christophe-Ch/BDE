@extends('layout/base')

@section('header')
<div class="notifications-container">
    @if($notifications->count())
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
    @else
        <h2>Vous n'avez pas de notifications.</h2>
    @endif
</div>
@endsection