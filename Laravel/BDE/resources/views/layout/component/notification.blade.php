<div class="notification">
    <p>{{ $date }}</p>
    <div class="content">
        <a href="{{ $linkUrl }}"><h3>{{ $title }}</h3></a>
        <p>{{ $content }}</p>
    </div>
    <form action="/notifications/{{ $id }}" method="post">
        @csrf
        @method('delete')
        <input type="image" src="/images/bin.png" alt="Delete button">
    </form>
</div>