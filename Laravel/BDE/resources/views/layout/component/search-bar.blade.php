<div id="search-bar-container">
    <div id="search-bar">
        <form id="search_form" action="{{ $url }}">
            @csrf
            <div class="ui-widget">
                <img src="/images/search.png" alt="Search">
                <input id="autocomplete" type="text" name="search" placeholder="{{$placeholder}}">
            </div>
        </form>

        <button type="submit" form="search_form">
                Rechercher
            </button>
    </div>
</div>
