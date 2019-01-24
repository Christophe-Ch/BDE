<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Achat;

class ArticlesController extends Controller
{
    public function index() {
        $articles = null;

        if(request()->has('filter')) {
            switch(request('filter')) {
                case "price-asc":
                    $articles = Article::orderBy('prix', 'ASC')->get();
                    break;

                case "price-desc":
                    $articles = Article::orderBy('prix', 'DESC')->get();
                    break;

                case "Vêtements":
                    $articles = Article::where('categorie', 1)->get();
                    break;

                case "Goodies":
                    $articles = Article::where('categorie', 2)->get();
                    break;
                
                case "undefined":
                    $articles = Article::all();
                    break;

                default:
                    $articles = Article::all();
            }
        }
        
        else {
            $articles = Article::where('centre_id', env('CENTRE_ID', 1))->get();
        }
        
        $top_articles = Article::select('id')->orderBy('achat', 'DESC')->take(3)->get();
        $top_article0 = Article::find($top_articles[0]->id);
        $top_article1 = Article::find($top_articles[1]->id);
        $top_article2 = Article::find($top_articles[2]->id);

        return view('articles.index', compact('articles', 'top_articles', 'top_article0', 'top_article1', 'top_article2'));
    }

    public function create() {
        return view('articles.create');
    }

    public function store() {

        request()->validate([
            'nom' => 'required|max:40',
            'description' => 'required|max:200',
            'date' => 'required|date',
            'prix' => 'required|integer',
            'recurrence' => 'required|integer',
            'photo' => 'required|image'
        ]);

        $article = new Article();

        $article->nom = request('name');
        $article->description = request('description');
        $article->categorie = request('category');
        $article->prix = request('price');
        $article->photo = request('pic');
        $article->stock = request('stock');
        $article->centre_id = env('CENTRE_ID', 1);

        $article->save();

        return redirect('/articles');

    }
    
}
