<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Galeri</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-stone-50 text-stone-800">
    <nav class="bg-teal-700 text-white">
        <div class="max-w-5xl mx-auto px-6 py-3">
            <a href="/admin/galeri" class="font-bold text-lg">← Kembali</a>
        </div>
    </nav>

    <form method="POST" enctype="multipart/form-data"
          action="{{ $item->exists ? '/admin/galeri/'.$item->id : '/admin/galeri' }}"
          class="max-w-xl mx-auto mt-8 bg-white p-6 rounded-xl shadow space-y-3">
        @csrf
        @if ($item->exists)
            @method('PUT')
        @endif

        <h1 class="text-xl font-bold">{{ $item->exists ? 'Edit' : 'Tambah' }} Galeri</h1>

        @foreach ($errors->all() as $error)
            <p class="text-red-600 text-sm">{{ $error }}</p>
        @endforeach

        <label class="block text-sm font-medium">Destinasi
            <select name="destinasi_id" class="w-full border rounded p-2">
                <option value="">-- pilih --</option>
                @foreach ($destinasi as $d)
                    <option value="{{ $d->id }}" @selected(old('destinasi_id', $item->destinasi_id) == $d->id)>
                        {{ $d->nama_destinasi }}
                    </option>
                @endforeach
            </select>
        </label>

        <label class="block text-sm font-medium">Judul
            <input name="judul" value="{{ old('judul', $item->judul) }}" class="w-full border rounded p-2">
        </label>

        <label class="block text-sm font-medium">Jenis media
            <select name="jenis_media" class="w-full border rounded p-2">
                @foreach (['foto' => 'Foto', 'video' => 'Video', 'virtual_tour' => 'Virtual Tour'] as $nilai => $label)
                    <option value="{{ $nilai }}" @selected(old('jenis_media', $item->jenis_media) == $nilai)>{{ $label }}</option>
                @endforeach
            </select>
        </label>

        <div class="border rounded p-3 bg-stone-50 space-y-2">
            <p class="text-sm font-medium">Media (pilih salah satu)</p>

            @if ($item->file_media)
                <p class="text-xs text-stone-500">
                    Saat ini: <a href="{{ $item->media_url }}" target="_blank" class="underline text-teal-700">lihat media</a>.
                    Kosongkan dua kolom di bawah kalau tidak ingin mengganti.
                </p>
            @endif

            <label class="block text-sm">Upload file (foto atau video, maks. 20 MB)
                <input type="file" name="file_media" accept="image/*,video/mp4,video/webm" class="w-full border rounded p-2 bg-white">
            </label>

            <label class="block text-sm">Atau tempel link (misalnya link virtual tour)
                <input type="url" name="link_media" value="{{ old('link_media') }}" placeholder="https://..." class="w-full border rounded p-2">
            </label>
        </div>

        <label class="block text-sm font-medium">Deskripsi
            <textarea name="deskripsi" rows="3" class="w-full border rounded p-2">{{ old('deskripsi', $item->deskripsi) }}</textarea>
        </label>

        <button class="bg-teal-700 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</body>
</html>