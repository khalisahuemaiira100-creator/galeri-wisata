<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destinasi;
use App\Models\Promosi;
use Illuminate\Http\Request;

class PromosiController extends Controller
{
    public function index()
    {
        return view('admin.promosi.index', [
            'daftar' => Promosi::with('destinasi')->latest()->get(),
        ]);
    }

    public function create()
    {
        return view('admin.promosi.form', [
            'item' => new Promosi(),
            'destinasi' => Destinasi::all(),
        ]);
    }

    public function store(Request $request)
    {
        Promosi::create($this->validasi($request));

        return redirect('/admin/promosi')->with('ok', 'Promosi berhasil ditambahkan');
    }

    public function edit(Promosi $promosi)
    {
        return view('admin.promosi.form', [
            'item' => $promosi,
            'destinasi' => Destinasi::all(),
        ]);
    }

    public function update(Request $request, Promosi $promosi)
    {
        $promosi->update($this->validasi($request));

        return redirect('/admin/promosi')->with('ok', 'Promosi berhasil diperbarui');
    }

    public function destroy(Promosi $promosi)
    {
        $promosi->delete();

        return redirect('/admin/promosi')->with('ok', 'Promosi berhasil dihapus');
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