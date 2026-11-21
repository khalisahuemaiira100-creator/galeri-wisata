<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-stone-50 text-stone-800">
    <nav class="bg-teal-700 text-white">
        <div class="max-w-5xl mx-auto px-6 py-3 flex items-center gap-4">
            <a href="/destinasi" class="font-bold text-lg mr-auto">Galeri Wisata</a>
            <form method="POST" action="/logout">
                @csrf
                <button class="underline text-sm">Logout</button>
            </form>
        </div>
    </nav>

    <div class="max-w-5xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-2">Dashboard Administrator</h1>

        <div class="mb-6 flex flex-wrap gap-2">
            <a href="/admin/destinasi" class="bg-teal-700 text-white px-3 py-2 rounded text-sm">Kelola Destinasi</a>
            <a href="/admin/artikel" class="bg-teal-700 text-white px-3 py-2 rounded text-sm">Kelola Artikel</a>
            <a href="/admin/promosi" class="bg-teal-700 text-white px-3 py-2 rounded text-sm">Kelola Promosi</a>
            <a href="/admin/galeri" class="bg-teal-700 text-white px-3 py-2 rounded text-sm">Kelola Galeri</a>
            <a href="/admin/laporan" class="bg-amber-600 text-white px-3 py-2 rounded text-sm">Laporan</a>
        </div>

        <div class="grid md:grid-cols-3 gap-4">
            <div class="bg-white rounded-xl shadow p-4">
                <p class="text-sm text-stone-500">Pengguna</p>
                <p class="text-3xl font-bold">{{ $jumlahPengguna }}</p>
            </div>
            <div class="bg-white rounded-xl shadow p-4">
                <p class="text-sm text-stone-500">Destinasi</p>
                <p class="text-3xl font-bold">{{ $jumlahDestinasi }}</p>
            </div>
            <div class="bg-white rounded-xl shadow p-4">
                <p class="text-sm text-stone-500">Kategori</p>
                <p class="text-3xl font-bold">{{ $jumlahKategori }}</p>
            </div>
        </div>
    </div>
</body>
</html>