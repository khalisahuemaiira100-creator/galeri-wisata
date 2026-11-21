<?php

namespace App\Http\Controllers;

use App\Models\Promosi;

class PromosiController extends Controller
{
    public function index()
    {
        return view('promosi.index', [
            'daftar' => Promosi::with('destinasi')->latest()->get(),
        ]);
    }
}