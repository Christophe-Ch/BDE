<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DownloadController extends Controller
{
    public function downloadImages(){
        if(Auth::user()->statut_id != 3) return back();
        $this->createZip();
        return response()->download(public_path('allImages.zip'));
    }
    private function createZip(){
        $zipper = new \Chumper\Zipper\Zipper;
        $files = glob(public_path('storage/*'));
        $zipper->make(public_path('allImages.zip'))->add($files);
    }
}
