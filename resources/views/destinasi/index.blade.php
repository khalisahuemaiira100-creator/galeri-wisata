<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Destinasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-stone-50 text-stone-800">
    <nav class="bg-teal-700 text-white">
        <div class="max-w-5xl mx-auto px-6 py-3 flex items-center gap-4">
            <a href="/destinasi" class="font-bold text-lg mr-auto">Galeri Wisata</a>
            <a href="/destinasi" class="text-sm">Destinasi</a>
            <a href="/artikel" class="text-sm">Artikel</a>
            <a href="/promosi" class="text-sm">Promosi</a>
            <a href="/galeri" class="text-sm">Galeri</a>
            <span class="text-sm">Halo, {{ auth()->user()->name }}</span>

            @if (auth()->user()->role === 'admin')
                <a href="/admin" class="bg-white/20 px-3 py-1 rounded text-sm">Admin</a>
            @endif

            <form method="POST" action="/logout">
                @csrf
                <button class="underline text-sm">Logout</button>
            </form>
        </div>
    </nav>

    <div class="max-w-5xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Destinasi Wisata</h1>

        <div class="grid md:grid-cols-3 gap-4">
            @foreach ($daftar as $d)
                <div class="bg-white rounded-xl shadow overflow-hidden">
                    @if ($d->gambar)
                        <img src="{{ asset('storage/'.$d->gambar) }}" alt="{{ $d->nama_destinasi }}" class="h-40 w-full object-cover">
                    @else
                        <div class="h-40 bg-teal-50 flex items-center justify-center text-teal-700 text-sm">Belum ada foto</div>
                    @endif
                    <div class="p-4">
                        <h2 class="font-bold text-lg">{{ $d->nama_destinasi }}</h2>
                        <p class="text-sm text-teal-700">
                            {{ $d->kategori->nama_kategori ?? '-' }} · {{ $d->lokasi }}
                        </p>
                        <p class="mt-2 text-sm">{{ $d->deskripsi }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>