<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\Destinasi;
use Illuminate\Http\Request;

class ArtikelController extends Controller
{
    public function index()
    {
        return view('admin.artikel.index', [
            'daftar' => Artikel::with('destinasi')->latest()->get(),
        ]);
    }

    public function create()
    {
        return view('admin.artikel.form', [
            'item' => new Artikel(),
            'destinasi' => Destinasi::all(),
        ]);
    }

    public function store(Request $request)
    {
        Artikel::create($this->validasi($request));

        return redirect('/admin/artikel')->with('ok', 'Artikel berhasil ditambahkan');
    }

    public function edit(Artikel $artikel)
    {
        return view('admin.artikel.form', [
            'item' => $artikel,
            'destinasi' => Destinasi::all(),
        ]);
    }

    public function update(Request $request, Artikel $artikel)
    {
        $artikel->update($this->validasi($request));

        return redirect('/admin/artikel')->with('ok', 'Artikel berhasil diperbarui');
    }

    public function destroy(Artikel $artikel)
    {
        $artikel->delete();

        return redirect('/admin/artikel')->with('ok', 'Artikel berhasil dihapus');
    }

    private function validasi(Request $request)
    {
        return $request->validate([
            'judul' => 'required',
            'destinasi_id' => 'nullable|exists:destinasi,id',
            'isi' => 'required',
        ]);
    }
}