<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Galeri Wisata</title>
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
        <h1 class="text-3xl font-bold mb-6">Galeri Wisata</h1>

        <div class="grid md:grid-cols-3 gap-4">
            @forelse ($daftar as $g)
                <div class="bg-white rounded-xl shadow overflow-hidden">
                    @if ($g->jenis_media === 'foto' && $g->media_url)
                        <img src="{{ $g->media_url }}" alt="{{ $g->judul }}" class="h-40 w-full object-cover">
                    @elseif ($g->jenis_media === 'video' && $g->is_video_file)
                        <video src="{{ $g->media_url }}" controls class="h-40 w-full object-cover bg-black"></video>
                    @else
                        <div class="h-40 bg-teal-50 flex items-center justify-center text-teal-700 text-sm">
                            {{ $g->jenis_media === 'virtual_tour' ? 'Virtual Tour 360°' : 'Video' }}
                        </div>
                    @endif

                    <div class="p-4">
                        <h2 class="font-bold">{{ $g->judul }}</h2>
                        <p class="text-sm text-teal-700">{{ $g->destinasi->nama_destinasi ?? '-' }}</p>
                        <p class="text-sm mt-1">{{ $g->deskripsi }}</p>

                        @if ($g->jenis_media === 'virtual_tour' && $g->media_url)
                            <a href="{{ $g->media_url }}" target="_blank" class="inline-block mt-2 bg-teal-700 text-white px-3 py-1 rounded text-sm">Buka Virtual Tour</a>
                        @elseif ($g->jenis_media === 'video' && $g->media_url && !$g->is_video_file)
                            <a href="{{ $g->media_url }}" target="_blank" class="inline-block mt-2 bg-teal-700 text-white px-3 py-1 rounded text-sm">Putar Video</a>
                        @endif
                    </div>
                </div>
            @empty
                <p>Belum ada galeri.</p>
            @endforelse
        </div>
    </div>
</body>
</html>