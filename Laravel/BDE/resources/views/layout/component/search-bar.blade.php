<div id="search-bar-container">
    <div id="search-bar">
        <form id="search_form" action="/ideas/search" method="post">
            @csrf
            <div>
                <img src="/images/search.png" alt="Search">
                <input type="text" name="search" placeholder="{{$placeholder}}">
            </div>
        </form>

        <button type="submit" form="search_form">
                Rechercher
            </button>
    </div>
</div>
