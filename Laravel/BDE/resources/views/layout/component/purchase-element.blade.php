<div id="purchase-element">
    <img src="{{$src}}" alt="{{$alt}}">
    <h3>{{$title}}</h3>
    <div id="stock">
        <form action="/purchase/{{$id}}" name="quantity">
            @csrf
            @method('PUT')
            <input type="submit" value="-">
        </form>
        <div id="stock-id">{{$stock}}</div>
        <form action="/purchase/{{$id}}" name="quantity">
            @csrf
            @method('PUT')
            <input type="submit" value="+">
        </form>
        
    </div>
    <div>
        {{$price}}€
    </div>
    <form action="/purchase/{{$id}}" method="POST">
        @csrf
        @method('DELETE')
        <input id="delete" type="image" src="/images/fermeture.png">
    </form>
</div>