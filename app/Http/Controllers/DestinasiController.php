<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;

class DestinasiController extends Controller
{
    public function index()
    {
        $daftar = Destinasi::with('kategori')->get();

        return view('destinasi.index', ['daftar' => $daftar]);
    }
}