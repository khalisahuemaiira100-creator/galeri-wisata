<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Promosi Wisata</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-stone-50 text-stone-800">
    <nav class="bg-teal-700 text-white">
        <div class="max-w-5xl mx-auto px-6 py-3 flex items-center gap-4">
            <a href="/destinasi" class="font-bold text-lg mr-auto">Galeri Wisata</a>
            <a href="/destinasi" class="text-sm">Destinasi</a>
            <a href="/artikel" class="text-sm">Artikel</a>
            <a href="/promosi" class="text-sm">Promosi</a>
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
        <h1 class="text-3xl font-bold mb-6">Promosi Wisata</h1>

        <div class="grid md:grid-cols-2 gap-4">
            @forelse ($daftar as $p)
                <div class="bg-amber-50 border border-amber-200 rounded-xl p-4">
                    <h2 class="font-bold text-lg">{{ $p->judul }}</h2>
                    <p class="text-sm text-teal-700">{{ $p->destinasi->nama_destinasi ?? 'Umum' }}</p>
                    <p class="mt-2 text-sm whitespace-pre-line">{{ $p->isi }}</p>
                </div>
            @empty
                <p>Belum ada promosi.</p>
            @endforelse
        </div>
    </div>
</body>
</html>