<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $table = 'galeri';
    protected $guarded = [];

    public function destinasi()
    {
        return $this->belongsTo(Destinasi::class);
    }

    public function getMediaUrlAttribute()
    {
        if (!$this->file_media) {
            return null;
        }

        return str_starts_with($this->file_media, 'http')
            ? $this->file_media
            : asset('storage/' . $this->file_media);
    }

    public function getIsVideoFileAttribute()
    {
        return (bool) preg_match('/\.(mp4|webm)$/i', (string) $this->file_media);
    }
}