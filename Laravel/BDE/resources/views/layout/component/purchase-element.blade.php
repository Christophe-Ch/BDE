<div class="purchase-element">
    <div class="purchase-left">
        <img src="{{$src}}" alt="{{$alt}}">
        <h3>{{$title}}</h3>
    </div>
    
    <div class="purchase-right">
        <div class="left-side">
            <div class="quantity">
                <form action="/purchase/{{$id}}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="submit" value="-" name="quantity">
                </form>
                <div class="quantity-id">{{$quantity}}</div>
                <form action="/purchase/{{$id}}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="submit" value="+" name="quantity">
                </form>
            </div>
            <div class="price">
                {{$price}}€
            </div>
        </div>
        <form action="/purchase/{{$id}}" method="POST">
            @csrf
            @method('DELETE')
            <input class="delete" type="image" src="/images/fermeture.png" alt="close">
        </form>
    </div>
    
</div>