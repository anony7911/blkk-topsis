<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rekomendasi extends Model
{
    use softDeletes;
    use HasFactory;
    protected $table = 'rekomendasis';
    protected $fillable = ['alternatif_id', 'nilai_preferensi', 'keterangan'];
    protected $dates = ['deleted_at'];
}
