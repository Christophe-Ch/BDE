<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use App\Article;
use App\Achat;
use App\Categorie;

class ArticlesController extends Controller
{

    // Display shop page
    public function index() {
        $articles = null;

        if(request()->has('filter')) { //if a filter is set
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
                    $articles = Article::where('centre_id', env('CENTRE_ID', 1))->get();
                    break;

                default:
                    $articles = Article::where('centre_id', env('CENTRE_ID', 1))->get();
            }
        }
        
        else {
            $articles = Article::where('centre_id', env('CENTRE_ID', 1))->get();
        }
        
        // articles most purchased
        $top_articles = Article::select('id')->where('centre_id', env('CENTRE_ID', 1))->orderBy('achat', 'DESC')->take(3)->get();
        $top_article0 = Article::find($top_articles[0]->id);
        $top_article1 = Article::find($top_articles[1]->id);
        $top_article2 = Article::find($top_articles[2]->id);

        return view('articles.index', compact('articles', 'top_articles', 'top_article0', 'top_article1', 'top_article2'));
    }

    // Display a form for creating a new article
    public function create() {
        // if connected user is not a BDE member
        if(Auth::user() && Auth::user()->statut_id != 2)
            return back();

        $categories = Categorie::all();

        return view('articles.create', compact('categories'));
    }

    // Create a new article
    public function store(Request $request) {

        if(Auth::user() && Auth::user()->statut_id != 2)
            return back();

        // Check if form fields are correct
        request()->validate([
            'name' => 'required|max:40',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'category' => 'required|integer',
            'description' => 'required|max:200',
            'pic' => 'required|image'
        ]);

        // Store article's image
        $extension =  request()->file('pic')->extension();
        $path = request('name') .'.'. $extension;
        Image::make(request()->file('pic'))->save(public_path('storage/'.$path));

        $article = new Article();

        $article->nom = request('name');
        $article->description = request('description');
        $article->categorie = request('category');
        $article->prix = request('price');
        $article->photo = $path;
        $article->stock = request('stock');
        $article->centre_id = env('CENTRE_ID', 1);

        $article->save();

        return redirect('/articles');

    }


    // Display a form for editing an article
    public function edit(Article $article) {
        if(Auth::user() && Auth::user()->statut_id != 2)
            return back();
        
        $categories = Categorie::all();
        return view('articles.edit', compact('article', 'categories'));
    }

    // Update an article
    public function update(Article $article) {
        if(Auth::user() && Auth::user()->statut_id != 2)
            return back();

        request()->validate([
            'name' => 'required|max:40',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'category' => 'required|integer',
            'description' => 'required|max:200',
            'pic' => 'required|image'
        ]);

        $extension =  request()->file('pic')->extension();
        $path = request('name') .'.'. $extension;
        Image::make(request()->file('pic'))->save(public_path('storage/'.$path));


        $article->nom = request('name');
        $article->description = request('description');
        $article->categorie = request('category');
        $article->prix = request('price');
        $article->photo = $path;
        $article->stock = request('stock');
        $article->centre_id = env('CENTRE_ID', 1);

        $article->save();

        return redirect('/articles');
    }

    // Delete an article
    public function destroy(Article $article) {
        if(Auth::user() && Auth::user()->statut_id != 2)
            return back();

        $article->delete();

        return redirect('/articles');
    }

    // Display articles requested by the user in the searchbar
    public function search(Request $request) {

        $request->validate([
            'search' => 'max:40',
        ]);

        if($request->input('search') != null) {
            if(Auth::check()) {
                $articles = Article::where("nom", 'LIKE', '%' . $request->input('search') . '%')->where("centre_id", Auth::user()->centre_id)->orWhere("description", 'LIKE', '%' . $request->input('search') . '%')->get();
            } else {
                $articles = Idee::where("nom", 'LIKE', '%' . $request->input('search') . '%')->where("centre_id", env("centre_id", 1))->orWhere("description", 'LIKE', '%' . $request->input('search') . '%')->get();
            }

            $top_articles = Article::select('id')->where('centre_id', env('CENTRE_ID', 1))->orderBy('achat', 'DESC')->take(3)->get();
            $top_article0 = Article::find($top_articles[0]->id);
            $top_article1 = Article::find($top_articles[1]->id);
            $top_article2 = Article::find($top_articles[2]->id);

            return view('articles.index', compact('articles', 'top_article0', 'top_article1', 'top_article2'));
        } else {
            return redirect('/articles');
        }
    }
    
}
