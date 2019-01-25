<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Achat;

class PurchaseController extends Controller
{
    public function index() {
        
    }

    public function store() {
        $achat = new Achat();

        $achat->article_id = request('id');
        $achat->user_id = Auth::user()->id;
        $achat->quantite = 1;

        $achat->save();
    }

    public function update() {
        
    }

    public function destroy() {
        
    }
}
