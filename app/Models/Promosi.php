<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promosi extends Model
{
    protected $table = 'promosi';
    protected $guarded = [];

    public function destinasi()
    {
        return $this->belongsTo(Destinasi::class);
    }
}