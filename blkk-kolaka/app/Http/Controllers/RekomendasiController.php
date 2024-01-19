<?php

namespace App\Http\Controllers;

use App\Models\Rekomendasi;
use Illuminate\Http\Request;

class RekomendasiController extends Controller
{
    public function index()
    {
        $rekomendasis = Rekomendasi::join('alternatifs', 'rekomendasis.alternatif_id', '=', 'alternatifs.id')
            ->select('rekomendasis.*', 'alternatifs.nama_lengkap', 'alternatifs.nis', 'alternatifs.kelas')
            ->get();
        return view('rekomendasi', compact('rekomendasis'));
    }
}
