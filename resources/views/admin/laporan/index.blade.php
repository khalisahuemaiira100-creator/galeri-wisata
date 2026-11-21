<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan</title>
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
            <h1 class="text-2xl font-bold">Laporan</h1>
            <a href="/admin/laporan/unduh" class="bg-teal-700 text-white px-3 py-2 rounded text-sm">Unduh Laporan (CSV)</a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-6">
            @foreach ($stat as $nama => $jumlah)
                <div class="bg-white rounded-xl shadow p-4">
                    <p class="text-sm text-stone-500">{{ $nama }}</p>
                    <p class="text-2xl font-bold">{{ $jumlah }}</p>
                </div>
            @endforeach
        </div>

        <h2 class="font-bold mb-2">Riwayat Akses Terbaru</h2>
        <table class="w-full bg-white rounded shadow text-sm mb-6">
            <tr class="bg-stone-100 text-left">
                <th class="p-3">Waktu</th>
                <th class="p-3">Pengguna</th>
                <th class="p-3">Aktivitas</th>
            </tr>
            @forelse ($riwayat as $r)
                <tr class="border-t">
                    <td class="p-3">{{ $r->created_at->format('d M Y H:i') }}</td>
                    <td class="p-3">{{ $r->user->name ?? '-' }}</td>
                    <td class="p-3">{{ $r->aktivitas }}</td>
                </tr>
            @empty
                <tr><td class="p-3" colspan="3">Belum ada riwayat.</td></tr>
            @endforelse
        </table>

        <h2 class="font-bold mb-2">Laporan yang Pernah Diunduh</h2>
        <ul class="text-sm list-disc ml-5">
            @forelse ($unduhan as $u)
                <li>{{ $u->periode }} (diunduh {{ $u->tanggal }})</li>
            @empty
                <li>Belum ada.</li>
            @endforelse
        </ul>
    </div>
</body>
</html>