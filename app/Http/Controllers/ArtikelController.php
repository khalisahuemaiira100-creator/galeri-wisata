<?php

namespace App\Http\Controllers;

use App\Models\Artikel;

class ArtikelController extends Controller
{
    public function index()
    {
        return view('artikel.index', [
            'daftar' => Artikel::with('destinasi')->latest()->get(),
        ]);
    }

    public function show(Artikel $artikel)
    {
        return view('artikel.show', ['a' => $artikel->load('destinasi')]);
    }
}