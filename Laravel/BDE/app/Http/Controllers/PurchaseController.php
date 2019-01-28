<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Achat;
use App\Article;

class PurchaseController extends Controller
{
    public function index() {
        $achats = Achat::where('user_id', Auth::user()->id)->get();

        $articles = [];
        $price = 0;

        foreach($achats as $achat) {
            $article = Article::find($achat->article_id);
            $price += $article->prix * $achat->quantite;

            array_push($articles, $article);
        }


        return view('purchase', compact('articles', 'achats', 'price'));
    }

    public function store() {
        $achat = new Achat();

        

        $achat->article_id = request('id');
        $achat->user_id = Auth::user()->id;
        $achat->quantite = 1;

        $achat->save();

        $article = Article::find($achat->article_id);
        $article->stock--;
        $article->save();

        return redirect('/articles');
    }

    public function update(Achat $purchase) {
        if(Auth::user()->statut_id != 2)
            return back();
        
        $article = Article::find($purchase->article_id);

        if(request()->has('quantity')) {
            if(request('quantity') == '+') {
                $purchase->quantite++;
                $article->stock--;
                $purchase->save();
                $article->save();
            }

            elseif (request('quantity') == '-') {
                $purchase->quantite--;
                $article->stock++;
                $purchase->save();
                $article->save();

                if($purchase->quantite == 0)
                    $purchase->delete();

            }
        }

        return redirect('/purchase');
    }

    public function destroy(Achat $purchase) {
        if(Auth::user()->statut_id != 2)
            return back();
        
        $purchase->delete();

        return redirect('/purchase');

    }
}
