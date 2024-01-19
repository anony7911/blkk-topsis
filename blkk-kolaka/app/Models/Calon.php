<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calon extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_calon',
        'alamat_calon',
        'no_hp_calon',
        'email_calon',
        'file_id',
        'tulisan_id',
        'wawancara_id',
        'surat_id',
        'domisili_id',
        'jurusan_id',
    ];
}
