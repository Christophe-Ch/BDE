<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Achat;

class ArticlesController extends Controller
{
    public function index() {
        $articles = Article::all();
        $top_articles = Achat::select('article_id')->groupBy('article_id')->orderByRaw('count(*) DESC')->take(3)->get();
        $top_article0 = Article::find($top_articles[0]->article_id);
        $top_article1 = Article::find($top_articles[1]->article_id);
        $top_article2 = Article::find($top_articles[2]->article_id);

        return view('articles.index', compact('articles', 'top_articles', 'top_article0', 'top_article1', 'top_article2'));
    }
    
}
