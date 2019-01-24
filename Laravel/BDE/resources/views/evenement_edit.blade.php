@extends('layout.duo')

@section('title')
    Modification d'un Evenement
@endsection

@section('img')
<img id="img_right" src="/images/Logo_bde2.png" alt="Logo">
@endsection

@section('content_form')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('event.update', ['event' => $id]) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put');
    <p class="title_input_left">Nom</p>
    <input class="input_left" type="text" name="nom" value="{{$event->nom}}"><br>

    <p class="title_input_left">Description</p>
    <input class="input_left" type="text" name="description" value="{{$event->description}}"><br>

    <p class="title_input_left">Date</p>
    <input class="input_left" type="date" name="date" value="{{substr($event->date, 0, 10)}}"><br>

    <p class="title_input_left">Prix</p>
    <input class="input_left" type="text" name="prix" value="{{$event->prix}}"><br>

    <p class="title_input_left">Photo</p>
    <input class="input_left" type="file" name="photo" value="{{$event->photo}}"><br>

    <input class="btn_left" type="submit" value="Modifier">
</form>
@endsection