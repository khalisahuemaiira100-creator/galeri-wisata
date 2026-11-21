<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destinasi;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        return view('admin.galeri.index', [
            'daftar' => Galeri::with('destinasi')->latest()->get(),
        ]);
    }

    public function create()
    {
        return view('admin.galeri.form', [
            'item' => new Galeri(),
            'destinasi' => Destinasi::all(),
        ]);
    }

    public function store(Request $request)
    {
        Galeri::create($this->data($request));

        return redirect('/admin/galeri')->with('ok', 'Galeri berhasil ditambahkan');
    }

    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.form', [
            'item' => $galeri,
            'destinasi' => Destinasi::all(),
        ]);
    }

    public function update(Request $request, Galeri $galeri)
    {
        $galeri->update($this->data($request, $galeri));

        return redirect('/admin/galeri')->with('ok', 'Galeri berhasil diperbarui');
    }

    public function destroy(Galeri $galeri)
    {
        $this->hapusFile($galeri);
        $galeri->delete();

        return redirect('/admin/galeri')->with('ok', 'Galeri berhasil dihapus');
    }

    private function data(Request $request, ?Galeri $lama = null)
    {
        $data = $request->validate([
            'destinasi_id' => 'required|exists:destinasi,id',
            'judul' => 'required',
            'jenis_media' => 'required|in:foto,video,virtual_tour',
            'deskripsi' => 'nullable',
            'file_media' => 'nullable|file|mimes:jpg,jpeg,png,webp,gif,mp4,webm|max:20480',
            'link_media' => 'nullable|url',
        ]);

        unset($data['file_media'], $data['link_media']);

        if ($request->hasFile('file_media')) {
            $this->hapusFile($lama);
            $data['file_media'] = $request->file('file_media')->store('galeri', 'public');
        } elseif ($request->filled('link_media')) {
            $this->hapusFile($lama);
            $data['file_media'] = $request->input('link_media');
        }

        return $data;
    }

    private function hapusFile(?Galeri $galeri)
    {
        if ($galeri && $galeri->file_media && !str_starts_with($galeri->file_media, 'http')) {
            Storage::disk('public')->delete($galeri->file_media);
        }
    }
}