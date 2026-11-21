<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Destinasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-stone-50 text-stone-800">
    <nav class="bg-teal-700 text-white">
        <div class="max-w-5xl mx-auto px-6 py-3">
            <a href="/admin/destinasi" class="font-bold text-lg">← Kembali</a>
        </div>
    </nav>

    <form method="POST" enctype="multipart/form-data"
          action="{{ $item->exists ? '/admin/destinasi/'.$item->id : '/admin/destinasi' }}"
          class="max-w-xl mx-auto mt-8 bg-white p-6 rounded-xl shadow space-y-3">
        @csrf
        @if ($item->exists)
            @method('PUT')
        @endif

        <h1 class="text-xl font-bold">{{ $item->exists ? 'Edit' : 'Tambah' }} Destinasi</h1>

        @foreach ($errors->all() as $error)
            <p class="text-red-600 text-sm">{{ $error }}</p>
        @endforeach

        <label class="block text-sm font-medium">Nama Destinasi
            <input name="nama_destinasi" value="{{ old('nama_destinasi', $item->nama_destinasi) }}" class="w-full border rounded p-2">
        </label>

        <label class="block text-sm font-medium">Kategori
            <select name="kategori_id" class="w-full border rounded p-2">
                <option value="">-- pilih --</option>
                @foreach ($kategori as $k)
                    <option value="{{ $k->id }}" @selected(old('kategori_id', $item->kategori_id) == $k->id)>
                        {{ $k->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </label>

        <label class="block text-sm font-medium">Lokasi
            <input name="lokasi" value="{{ old('lokasi', $item->lokasi) }}" class="w-full border rounded p-2">
        </label>

        <label class="block text-sm font-medium">Deskripsi
            <textarea name="deskripsi" rows="4" class="w-full border rounded p-2">{{ old('deskripsi', $item->deskripsi) }}</textarea>
        </label>

        <label class="block text-sm font-medium">Foto destinasi (maks. 4 MB)
            @if ($item->gambar)
                <img src="{{ asset('storage/'.$item->gambar) }}" class="h-24 rounded my-2">
                <span class="block text-xs text-stone-500">Kosongkan kalau tidak ingin mengganti foto.</span>
            @endif
            <input type="file" name="gambar" accept="image/*" class="w-full border rounded p-2 mt-1">
        </label>

        <button class="bg-teal-700 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</body>
</html>