<div class="notification">
    <p>{{ $date }}</p>
    <div class="content">
        <h3>{{ $title }}</h3>
        <p>{{ $content }}</p>
    </div>
    <form action="/notifications/{{ $id }}" method="post">
        @csrf
        @method('delete')
        <input type="image" src="/images/bin.png">
    </form>
</div>