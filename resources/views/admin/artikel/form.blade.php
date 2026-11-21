<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Artikel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-stone-50 text-stone-800">
    <nav class="bg-teal-700 text-white">
        <div class="max-w-5xl mx-auto px-6 py-3">
            <a href="/admin/artikel" class="font-bold text-lg">← Kembali</a>
        </div>
    </nav>

    <form method="POST"
          action="{{ $item->exists ? '/admin/artikel/'.$item->id : '/admin/artikel' }}"
          class="max-w-xl mx-auto mt-8 bg-white p-6 rounded-xl shadow space-y-3">
        @csrf
        @if ($item->exists)
            @method('PUT')
        @endif

        <h1 class="text-xl font-bold">{{ $item->exists ? 'Edit' : 'Tambah' }} Artikel</h1>

        @foreach ($errors->all() as $error)
            <p class="text-red-600 text-sm">{{ $error }}</p>
        @endforeach

        <label class="block text-sm font-medium">Judul
            <input name="judul" value="{{ old('judul', $item->judul) }}" class="w-full border rounded p-2">
        </label>

        <label class="block text-sm font-medium">Destinasi terkait
            <select name="destinasi_id" class="w-full border rounded p-2">
                <option value="">-- pilih --</option>
                @foreach ($destinasi as $d)
                    <option value="{{ $d->id }}" @selected(old('destinasi_id', $item->destinasi_id) == $d->id)>
                        {{ $d->nama_destinasi }}
                    </option>
                @endforeach
            </select>
        </label>

        <label class="block text-sm font-medium">Isi artikel
            <textarea name="isi" rows="8" class="w-full border rounded p-2">{{ old('isi', $item->isi) }}</textarea>
        </label>

        <button class="bg-teal-700 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</body>
</html>