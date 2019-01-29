<style>
    * {
        font-family: "Segoe UI";
        font-weight: lighter;

        text-align: center;
    }
    
    a {
        background: rgba(0, 0, 0, .6);
        color: white;
        text-decoration: none;
        padding: 10px;
        border-radius: 10px;
    }
    
    p {
        margin-bottom: 40px;
    }
</style>
    
<h1>{{ $title }}</h1>
<h2>{{ $subtitle }}</h2>
<p>{{ $description }}</p>
@isset($list)
    @foreach ($list as $item)
        {{ $item }}<br>
    @endforeach
@endisset
<a href="{{ $url }}">{{ $linkText }}</a>