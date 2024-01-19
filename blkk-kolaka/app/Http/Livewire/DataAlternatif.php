<?php

namespace App\Http\Livewire;

use App\Models\File;
use App\Models\Calon;
use App\Models\Surat;
use App\Models\Jurusan;
use App\Models\Tulisan;
use Livewire\Component;
use App\Models\Domisili;
use App\Models\Wawancara;
use App\Models\Alternatif;
use Livewire\WithPagination;

class DataAlternatif extends Component
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

    protected $alternatifs, $files, $tulisans, $wawancaras, $surats, $domisilis, $jurusans;
    public $nama_lengkap, $nis, $kelas, $pekerjaan_ortu, $penghasilan_ortu, $jumlah_tanggungan, $status_anak, $pemegang_kks, $pemegang_pkh, $pemegang_sktm,
        $alternatifId;

        public $nama_calon, $alamat_calon, $no_hp_calon, $email_calon, $file_id, $tulisan_id, $wawancara_id, $surat_id, $domisili_id, $jurusan_id;
    public function resetInput()
    {
        $this->nama_calon = null;
        $this->alamat_calon = null;
        $this->no_hp_calon = null;
        $this->email_calon = null;
        $this->file_id = null;
        $this->tulisan_id = null;
        $this->wawancara_id = null;
        $this->surat_id = null;
        $this->domisili_id = null;
        $this->jurusan_id = null;

    }
    public function render()
    {
        // $this->alternatifs = Alternatif::where('nama_lengkap', 'like', '%' . $this->search . '%')
        //     ->orWhere('nis', 'like', '%' . $this->search . '%')
        //     ->orWhere('kelas', 'like', '%' . $this->search . '%')
        //     ->orderBy('id', 'desc')
        //     ->paginate($this->perPage);


        $this->alternatifs = Calon::join('files', 'calons.file_id', '=', 'files.id')
            ->join('tulisans', 'calons.tulisan_id', '=', 'tulisans.id')
            ->join('wawancaras', 'calons.wawancara_id', '=', 'wawancaras.id')
            ->join('surats', 'calons.surat_id', '=', 'surats.id')
            ->join('domisilis', 'calons.domisili_id', '=', 'domisilis.id')
            ->join('jurusans', 'calons.jurusan_id', '=', 'jurusans.id')
            ->select('calons.*', 'files.nama_file', 'tulisans.nama_tulisan', 'wawancaras.nama_wawancara', 'surats.nama_surat', 'domisilis.nama_domisili', 'jurusans.nama_jurusan')
            ->where('nama_calon', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate($this->perPage);
        return view('livewire.data-alternatif', [
            'alternatifs' => $this->alternatifs,
            'files' => File::all(),
            'tulisans' => Tulisan::all(),
            'wawancaras' => Wawancara::all(),
            'surats' => Surat::all(),
            'domisilis' => Domisili::all(),
            'jurusans' => Jurusan::all(),
        ]);
    }

    public function alternatifId($id)
    {
        $this->alternatifId = $id;

        $alternatif = Calon::findOrFail($id);

        $this->nama_calon = $alternatif->nama_calon;
        $this->alamat_calon = $alternatif->alamat_calon;
        $this->no_hp_calon = $alternatif->no_hp_calon;
        $this->email_calon = $alternatif->email_calon;
        $this->file_id = $alternatif->file_id;
        $this->tulisan_id = $alternatif->tulisan_id;
        $this->wawancara_id = $alternatif->wawancara_id;
        $this->surat_id = $alternatif->surat_id;
        $this->domisili_id = $alternatif->domisili_id;
        $this->jurusan_id = $alternatif->jurusan_id;

    }

    public function store()
    {
        $this->validate([
            'nama_calon' => 'required',
            'alamat_calon' => 'required',
            'no_hp_calon' => 'required',
            'email_calon' => 'required',
            'file_id' => 'required',
            'tulisan_id' => 'required',
            'wawancara_id' => 'required',
            'surat_id' => 'required',
            'domisili_id' => 'required',
            'jurusan_id' => 'required',
        ]);

        Calon::create([
            'nama_calon' => $this->nama_calon,
            'alamat_calon' => $this->alamat_calon,
            'no_hp_calon' => $this->no_hp_calon,
            'email_calon' => $this->email_calon,
            'file_id' => $this->file_id,
            'tulisan_id' => $this->tulisan_id,
            'wawancara_id' => $this->wawancara_id,
            'surat_id' => $this->surat_id,
            'domisili_id' => $this->domisili_id,
            'jurusan_id' => $this->jurusan_id,
        ]);
        $this->resetInput();
        session()->flash('success', 'Data Alternatif berhasil ditambahkan');

    }

    public function update()
    {
        $alternatif = Calon::findOrFail($this->alternatifId);
        $alternatif->update([
            'nama_calon' => $this->nama_calon,
            'alamat_calon' => $this->alamat_calon,
            'no_hp_calon' => $this->no_hp_calon,
            'email_calon' => $this->email_calon,
            'file_id' => $this->file_id,
            'tulisan_id' => $this->tulisan_id,
            'wawancara_id' => $this->wawancara_id,
            'surat_id' => $this->surat_id,
            'domisili_id' => $this->domisili_id,
            'jurusan_id' => $this->jurusan_id,

        ]);
        $this->resetInput();
        session()->flash('success', 'Data Alternatif berhasil diubah');
    }

    public function edit($id)
    {
    }

    public function deleteAlternatif($id)
    {
        $alternatif = Calon::find($id);
        $alternatif->delete();
        session()->flash('error', 'Data Alternatif berhasil dihapus');
    }
}
