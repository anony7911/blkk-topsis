<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Kriteria;
use Livewire\WithPagination;

class DataKriteria extends Component
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

    protected $kriterias;
    public $nama_kriteria, $atribut_kriteria, $bobot_kriteria, $kriteriaId;

    public function resetInput()
    {
        $this->nama_kriteria = '';
        $this->atribut_kriteria = '';
        $this->bobot_kriteria = '';
    }

    public function render()
    {
        $this->kriterias = Kriteria::where('nama_kriteria', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate($this->perPage);
        return view('livewire.data-kriteria', [
            'kriterias' => $this->kriterias,
        ]);
    }

    public function kriteriaId($id)
    {
        $this->kriteriaId = $id;

        $kriteria = Kriteria::findOrFail($id);

        $this->nama_kriteria = $kriteria->nama_kriteria;
        $this->atribut_kriteria = $kriteria->atribut_kriteria;
        $this->bobot_kriteria = $kriteria->bobot_kriteria;
    }

    public function store()
    {
        $this->validate([
            'nama_kriteria' => 'required',
            'atribut_kriteria' => 'required',
            'bobot_kriteria' => 'required',
        ]);

        Kriteria::create([
            'nama_kriteria' => $this->nama_kriteria,
            'atribut_kriteria' => $this->atribut_kriteria,
            'bobot_kriteria' => $this->bobot_kriteria,
        ]);

        $this->resetInput();
        session()->flash('success', 'Kriteria berhasil ditambahkan');
    }

    public function update()
    {
        $kriteria = Kriteria::findOrFail($this->kriteriaId);

        $kriteria->update([
            'nama_kriteria' => $this->nama_kriteria,
            'atribut_kriteria' => $this->atribut_kriteria,
            'bobot_kriteria' => $this->bobot_kriteria,
        ]);

        $this->resetInput();
        session()->flash('success', 'Kriteria berhasil diubah');
    }

    public function delete($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        $kriteria->delete();
        session()->flash('success', 'Kriteria berhasil dihapus');
    }
}
