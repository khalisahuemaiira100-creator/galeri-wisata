<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destinasi;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DestinasiController extends Controller
{
    public function index()
    {
        return view('admin.destinasi.index', [
            'daftar' => Destinasi::with('kategori')->latest()->get(),
        ]);
    }

    public function create()
    {
        return view('admin.destinasi.form', [
            'item' => new Destinasi(),
            'kategori' => Kategori::all(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validasi($request);
        unset($data['gambar']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('destinasi', 'public');
        }

        Destinasi::create($data);

        return redirect('/admin/destinasi')->with('ok', 'Destinasi berhasil ditambahkan');
    }

    public function edit(Destinasi $destinasi)
    {
        return view('admin.destinasi.form', [
            'item' => $destinasi,
            'kategori' => Kategori::all(),
        ]);
    }

    public function update(Request $request, Destinasi $destinasi)
    {
        $data = $this->validasi($request);
        unset($data['gambar']);

        if ($request->hasFile('gambar')) {
            if ($destinasi->gambar) {
                Storage::disk('public')->delete($destinasi->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('destinasi', 'public');
        }

        $destinasi->update($data);

        return redirect('/admin/destinasi')->with('ok', 'Destinasi berhasil diperbarui');
    }

    public function destroy(Destinasi $destinasi)
    {
        if ($destinasi->gambar) {
            Storage::disk('public')->delete($destinasi->gambar);
        }

        $destinasi->delete();

        return redirect('/admin/destinasi')->with('ok', 'Destinasi berhasil dihapus');
    }

    private function validasi(Request $request)
    {
        return $request->validate([
            'nama_destinasi' => 'required',
            'kategori_id' => 'nullable|exists:kategori,id',
            'lokasi' => 'nullable',
            'deskripsi' => 'nullable',
            'gambar' => 'nullable|image|max:4096',
        ]);
    }
}