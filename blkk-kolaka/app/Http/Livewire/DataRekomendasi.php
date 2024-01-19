<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Rekomendasi;
use Livewire\WithPagination;

class DataRekomendasi extends Component
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

    protected $rekomendasis;
    public $alternatif_id, $nilai_preferensi, $keterangan, $rekomendasiId;

    public function render()
    {
        $this->rekomendasis = Rekomendasi::join('calons', 'rekomendasis.alternatif_id', '=', 'calons.id')
            ->join('jurusans', 'calons.jurusan_id', '=', 'jurusans.id')
            ->select('rekomendasis.*', 'calons.nama_calon', 'calons.alamat_calon', 'jurusans.nama_jurusan')
            ->where('calons.nama_calon', 'like', '%' . $this->search . '%')
            ->orderBy('nilai_preferensi', 'desc')
            ->paginate($this->perPage);
        return view('livewire.data-rekomendasi',[
            'rekomendasis' => $this->rekomendasis,
        ]);
    }

    public function resetRekomendasi(){
        Rekomendasi::where('deleted_at', null)->forceDelete();
        session()->flash('error', 'Data Rekomendasi Berhasil Dihapus');
    }

    //softDelete
    public function delete($id)
    {
        // softDelete
        $rekomendasi = Rekomendasi::find($id);
        $rekomendasi->delete();
        session()->flash('success', 'Data Rekomendasi Berhasil Ditandai Sebagai Penerima PIP');
    }
}
