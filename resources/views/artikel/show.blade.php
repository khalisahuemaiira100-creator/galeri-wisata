<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $a->judul }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-stone-50 text-stone-800">
    <nav class="bg-teal-700 text-white">
        <div class="max-w-5xl mx-auto px-6 py-3 flex items-center gap-4">
            <a href="/destinasi" class="font-bold text-lg mr-auto">Galeri Wisata</a>
            <a href="/destinasi" class="text-sm">Destinasi</a>
            <a href="/artikel" class="text-sm">Artikel</a>
            <a href="/promosi" class="text-sm">Promosi</a>
            <form method="POST" action="/logout">
                @csrf
                <button class="underline text-sm">Logout</button>
            </form>
        </div>
    </nav>

    <article class="max-w-2xl mx-auto p-6">
        <a href="/artikel" class="text-sm text-teal-700">← Semua artikel</a>
        <h1 class="text-3xl font-bold mt-2">{{ $a->judul }}</h1>
        <p class="text-sm text-stone-500 mb-4">
            {{ $a->destinasi->nama_destinasi ?? 'Umum' }} · {{ $a->created_at->format('d M Y') }}
        </p>
        <div class="whitespace-pre-line">{{ $a->isi }}</div>
    </article>
</body>
</html>