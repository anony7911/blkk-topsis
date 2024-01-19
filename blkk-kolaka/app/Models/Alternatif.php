<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;
    protected $table = 'alternatifs';
    protected $fillable = ['nama_lengkap', 'nis', 'kelas', 'pekerjaan_ortu', 'penghasilan_ortu', 'jumlah_tanggungan', 'status_anak', 'pemegang_kks', 'pemegang_pkh', 'pemegang_sktm'];
}
