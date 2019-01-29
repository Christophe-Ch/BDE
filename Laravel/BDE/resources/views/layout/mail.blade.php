<style>
* {
    font-family: "Segoe UI";
    font-weight: lighter;
}

.content {
    border: 2px solid rgba(0, 0, 0, .6);
    border-radius: 10px;
    
    padding: 10px;
    
    width: 500px;
    text-align: center;
}

a {
    background: rgba(0, 0, 0, .6);
    color: white;
    text-decoration: none;
    padding: 10px;
    border-radius: 10px 10px 0 0;
}

p {
    margin-bottom: 40px;
}
</style>

<h1>{{ $title }}</h1>
<div class="content">
  <h2>{{ $subtitle }}</h2>
  <p>{{ $description }}</p>
  <a href="{{ $url }}">{{ $linkText }}</a>
</div>