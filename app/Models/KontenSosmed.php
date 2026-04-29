<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KontenSosmed extends Model
{
    use HasFactory;

    protected $table = 'konten_sosmed';

    protected $fillable = [
        'platform',
        'judul',
        'link_konten',
        'tanggal_upload',
        'screenshot',
    ];

    protected $casts = [
        'tanggal_upload' => 'date',
    ];
}
