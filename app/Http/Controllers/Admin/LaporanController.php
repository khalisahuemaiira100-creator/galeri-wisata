<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Models\Destinasi;
use App\Models\Laporan;
use App\Models\Promosi;
use App\Models\RiwayatAkses;
use App\Models\User;

class LaporanController extends Controller
{
    public function index()
    {
        return view('admin.laporan.index', [
            'stat' => [
                'Pengguna' => User::where('role', 'user')->count(),
                'Destinasi' => Destinasi::count(),
                'Artikel' => Artikel::count(),
                'Promosi' => Promosi::count(),
            ],
            'riwayat' => RiwayatAkses::with('user')->latest()->take(20)->get(),
            'unduhan' => Laporan::latest()->take(5)->get(),
        ]);
    }

    public function unduh()
    {
        Laporan::create([
            'periode' => now()->format('F Y'),
            'tanggal' => now()->toDateString(),
            'user_id' => auth()->id(),
        ]);

        return response()->streamDownload(function () {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['Waktu', 'Pengguna', 'Aktivitas']);

            RiwayatAkses::with('user')->latest()->each(function ($r) use ($out) {
                fputcsv($out, [$r->created_at, $r->user->name ?? '-', $r->aktivitas]);
            });

            fclose($out);
        }, 'laporan-' . now()->format('Ymd') . '.csv');
    }
}