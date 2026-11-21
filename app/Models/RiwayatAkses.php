<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RiwayatAkses extends Model
{
    protected $table = 'riwayat_akses';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}