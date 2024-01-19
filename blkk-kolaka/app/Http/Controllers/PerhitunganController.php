<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;

class PerhitunganController extends Controller
{

    public function index()
    {
        $alternatifs = Alternatif::all();
        $kriterias = Kriteria::all();
        return view('perhitungan', compact('alternatifs', 'kriterias'));
    }
}
