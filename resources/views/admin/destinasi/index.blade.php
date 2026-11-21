<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Destinasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-stone-50 text-stone-800">
    <nav class="bg-teal-700 text-white">
        <div class="max-w-5xl mx-auto px-6 py-3 flex items-center gap-4">
            <a href="/admin" class="font-bold text-lg mr-auto">Admin Galeri Wisata</a>
            <a href="/destinasi" class="text-sm">Lihat Website</a>
            <form method="POST" action="/logout">
                @csrf
                <button class="underline text-sm">Logout</button>
            </form>
        </div>
    </nav>

    <div class="max-w-5xl mx-auto p-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Kelola Destinasi</h1>
            <a href="/admin/destinasi/create" class="bg-teal-700 text-white px-3 py-2 rounded text-sm">+ Tambah</a>
        </div>

        @if (session('ok'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('ok') }}</div>
        @endif

        <table class="w-full bg-white rounded shadow text-sm">
            <tr class="bg-stone-100 text-left">
                <th class="p-3">Nama</th>
                <th class="p-3">Kategori</th>
                <th class="p-3">Lokasi</th>
                <th class="p-3"></th>
            </tr>
            @foreach ($daftar as $d)
                <tr class="border-t">
                    <td class="p-3">{{ $d->nama_destinasi }}</td>
                    <td class="p-3">{{ $d->kategori->nama_kategori ?? '-' }}</td>
                    <td class="p-3">{{ $d->lokasi }}</td>
                    <td class="p-3 text-right">
                        <a href="/admin/destinasi/{{ $d->id }}/edit" class="text-teal-700">Edit</a>
                        <form method="POST" action="/admin/destinasi/{{ $d->id }}" class="inline" onsubmit="return confirm('Yakin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 ml-3">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</body>
</html>