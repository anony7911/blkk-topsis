<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Rekomendasi;
use Livewire\WithPagination;

class Penerima extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 10;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    protected $updatesQueryString = ['search'];

    protected $penerimas;
    public function render()
    {
        $this->penerimas = Rekomendasi::join('calons', 'rekomendasis.alternatif_id', '=', 'calons.id')
            ->join('jurusans', 'calons.jurusan_id', '=', 'jurusans.id')
            ->select('rekomendasis.*', 'calons.nama_calon', 'calons.alamat_calon', 'calons.no_hp_calon', 'calons.email_calon', 'jurusans.nama_jurusan')
            ->where('calons.nama_calon', 'like', '%' . $this->search . '%')
            ->orderBy('nilai_preferensi', 'desc')
            ->onlyTrashed()
            ->paginate($this->perPage);
        return view('livewire.penerima', [
            'penerimas' => $this->penerimas,
        ])->extends('layouts.template')->section('content');
    }
}
