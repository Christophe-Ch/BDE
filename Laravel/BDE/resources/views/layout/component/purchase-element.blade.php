<div id="purchase-element">
    <div id="left">
        <img src="{{$src}}" alt="{{$alt}}">
        <h3>{{$title}}</h3>
    </div>
    
    <div id="right">
        <div id="left-side">
            <div id="quantity">
                <form action="/purchase/{{$id}}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="submit" value="-" name="quantity">
                </form>
                <div id="quantity-id">{{$quantity}}</div>
                <form action="/purchase/{{$id}}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="submit" value="+" name="quantity">
                </form>
            </div>
            <div id="price">
                {{$price}}€
            </div>
        </div>
        <form action="/purchase/{{$id}}" method="POST">
            @csrf
            @method('DELETE')
            <input id="delete" type="image" src="/images/fermeture.png">
        </form>
    </div>
    
</div>