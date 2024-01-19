<?php

namespace App\Http\Livewire;

use App\Models\Calon;
use App\Models\Jurusan;
use Livewire\Component;
use App\Models\Kriteria;
use App\Models\Alternatif;
use App\Models\Rekomendasi;
use Livewire\WithPagination;

class DataPerhitungan extends Component
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

    public $kriterias, $alternatifs, $perhitungan;
    public $nama_kriteria, $atribut_kriteria, $bobot_kriteria, $kriteriaId;
    public $solusi_ideal_positif, $solusi_ideal_negatif;
    public $jarak_positif, $jarak_negatif;
    public $preferensi = [];
    public $nilai_preferensi = [], $alternatif_id, $rekomendasi, $jml_penerima, $keterangan, $jumlah_layak;
    public $id_alternatif_terbaik, $alternatif_terbaik, $alternatif_preferensi;
    public $sawAktif = true;
    public $topsisAktif = false;

    public $y_file, $y_domisili, $y_surat, $y_tulisan, $y_wawancara;
    public $max_file, $max_domisili, $max_surat, $max_tulisan, $max_wawancara;
    public $min_file, $min_domisili, $min_surat, $min_tulisan, $min_wawancara;
    public $normalisasiDomisili , $normalisasiFile, $normalisasiSurat, $normalisasiTulisan, $normalisasiWawancara;
    public $bobotFile, $bobotDomisili, $bobotSurat, $bobotTulisan, $bobotWawancara;

    public $mk, $kriteria, $idjurusan, $jurusanAktif = false, $jurusan;

    public function mount(){
        $this->jurusan = Jurusan::all();
        $this->idjurusan = $idjurusan ?? null;
        $this->jurusanAktif = true;
    }

    // public $nilai_preferensi;
    public function render()
    {
        $this->kriteria = Kriteria::all();
        $this->mk = Calon::join('surats', 'calons.surat_id', '=', 'surats.id')
                        ->join('tulisans', 'calons.tulisan_id', '=', 'tulisans.id')
                        ->join('wawancaras', 'calons.wawancara_id', '=', 'wawancaras.id')
                        ->join('domisilis', 'calons.domisili_id', '=', 'domisilis.id')
                        ->join('files', 'calons.file_id', '=', 'files.id')
                        ->join('jurusans', 'calons.jurusan_id', '=', 'jurusans.id')
                        ->select('calons.*', 'surats.bobot as bobot_surat', 'tulisans.bobot as bobot_tulisan', 'wawancaras.bobot as bobot_wawancara', 'domisilis.bobot as bobot_domisili', 'files.bobot as bobot_file', 'surats.nama_surat', 'tulisans.nama_tulisan', 'wawancaras.nama_wawancara', 'domisilis.nama_domisili', 'files.nama_file')
                        ->where('calons.jurusan_id', '=', $this->idjurusan)
                        ->orderBy('calons.id', 'asc')
                        ->get();
        // normalisasi dari tabel Calon (alternatif). kriteria terdiri dari 5 kriteria (surat, tulisan, wawancara, domisili, file). bobot dari foreign key masing masing kriteria.
        // 1. dapatkan total bobot dari masing masing kriteria
        // kriteria surat
        $surat = Calon::join('surats', 'calons.surat_id', '=', 'surats.id')
            ->select('calons.*', 'surats.bobot as bobot_surat')
                        ->where('calons.jurusan_id', '=', $this->idjurusan)
            ->get();
        $surat->map(function ($item) {
            $item->bobot_surat1 = pow($item->bobot_surat, 2);
            return $item;
        });
        $total_bobot_surat = $surat->sum('bobot_surat1');

        // kriteria tulisan
        $tulisan = Calon::join('tulisans', 'calons.tulisan_id', '=', 'tulisans.id')
            ->select('calons.*', 'tulisans.bobot as bobot_tulisan')
                        ->where('calons.jurusan_id', '=', $this->idjurusan)
            ->get();
        $tulisan->map(function ($item) {
            $item->bobot_tulisan1 = pow($item->bobot_tulisan, 2);
            return $item;
        });
        $total_bobot_tulisan = $tulisan->sum('bobot_tulisan1');
        // // kriteria wawancara
        // $wawancara = Calon::join('wawancaras', 'calons.wawancara_id', '=', 'wawancaras.id')
        //     ->select('calons.*', 'wawancaras.bobot as bobot_wawancara')
        //                 ->where('calons.jurusan_id', '=', $this->idjurusan)
        //     ->get();
        // $wawancara->map(function ($item) {
        //     $item->bobot_wawancara1 = pow($item->bobot_wawancara, 2);
        //     return $item;
        // });
        // $total_bobot_wawancara = $wawancara->sum('bobot_wawancara1');
        // // kriteria domisili
        // $domisili = Calon::join('domisilis', 'calons.domisili_id', '=', 'domisilis.id')
        //     ->select('calons.*', 'domisilis.bobot as bobot_domisili')
        //                 ->where('calons.jurusan_id', '=', $this->idjurusan)
        //     ->get();
        // $domisili->map(function ($item) {
        //     $item->bobot_domisili1 = pow($item->bobot_domisili, 2);
        //     return $item;
        // });
        // $total_bobot_domisili = $domisili->sum('bobot_domisili1');

        // // kriteria file, bobot_file dipangkat 2
        // $file = Calon::join('files', 'calons.file_id', '=', 'files.id')
        //     ->select('calons.*', 'files.bobot as bobot_file')
        //                 ->where('calons.jurusan_id', '=', $this->idjurusan)
        //     ->get();
        // // sebelum di total, bobot_file dipangkat 2
        // $file->map(function ($item) {
        //     $item->bobot_file1 = pow($item->bobot_file, 2);
        //     return $item;
        // });
        // // total bobot_file
        // $total_bobot_file = $file->sum('bobot_file1');

        // // 2. masing masing bobot dibagi dengan akar dari total bobot
        // // kriteria surat
        // foreach ($surat as $item){
        //     $this->normalisasiSurat[$item->id] = $item->bobot_surat / (sqrt($total_bobot_surat));
        // }
        // // kriteria tulisan
        // foreach ($tulisan as $item) {
        //     $this->normalisasiTulisan[$item->id] = $item->bobot_tulisan / (sqrt($total_bobot_tulisan));
        // }
        // // kriteria wawancara
        // foreach ($wawancara as $item) {
        //     $this->normalisasiWawancara[$item->id] = $item->bobot_wawancara / (sqrt($total_bobot_wawancara));
        // }
        // // kriteria domisili
        // foreach ($domisili as $item) {
        //     $this->normalisasiDomisili[$item->id] = $item->bobot_domisili / (sqrt($total_bobot_domisili));
        // }
        // //kriteria file
        // foreach($file as $item){
        //     $this->normalisasiFile[$item->id] = $item->bobot_file / (sqrt($total_bobot_file));
        // }

        // Inisialisasi variabel total bobot untuk masing-masing kriteria
        $total_bobot_surat = 0;
        $total_bobot_tulisan = 0;
        $total_bobot_wawancara = 0;
        $total_bobot_domisili = 0;
        $total_bobot_file = 0;

        foreach ($this->mk as $calon) {
            // Menghitung total bobot untuk setiap kriteria
            $total_bobot_surat += pow($calon->bobot_surat, 2);
            $total_bobot_tulisan += pow($calon->bobot_tulisan, 2);
            $total_bobot_wawancara += pow($calon->bobot_wawancara, 2);
            $total_bobot_domisili += pow($calon->bobot_domisili, 2);
            $total_bobot_file += pow($calon->bobot_file, 2);
        }

        // Normalisasi bobot untuk masing-masing kriteria
        foreach ($this->mk as $calon) {
            $calon->normalisasiSurat = $calon->bobot_surat / sqrt($total_bobot_surat);
            $calon->normalisasiTulisan = $calon->bobot_tulisan / sqrt($total_bobot_tulisan);
            $calon->normalisasiWawancara = $calon->bobot_wawancara / sqrt($total_bobot_wawancara);
            $calon->normalisasiDomisili = $calon->bobot_domisili / sqrt($total_bobot_domisili);
            $calon->normalisasiFile = $calon->bobot_file / sqrt($total_bobot_file);
        }

        // dd($normalisasiDomisili, $normalisasiFile, $normalisasiSurat, $normalisasiTulisan, $normalisasiWawancara, $file, $domisili, $wawancara, $tulisan, $surat);

        $this->alternatifs = Calon::join('jurusans', 'jurusans.id', 'calons.jurusan_id')
                                    ->select('calons.*', 'jurusans.id as jurusanid', 'jurusans.nama_jurusan')
                                    ->where('calons.jurusan_id', '=', $this->idjurusan)
                                    ->orderBy('calons.id', 'asc')
                                    ->get();
        // bobot tiap kriteria
        $bobotFile = Kriteria::where('id', '=', 1)->first()->bobot_kriteria;
        $bobotDomisili = Kriteria::where('id', '=', 4)->first()->bobot_kriteria;
        $bobotSurat = Kriteria::where('id', '=', 5)->first()->bobot_kriteria;
        $bobotTulisan = Kriteria::where('id', '=',2)->first()->bobot_kriteria;
        $bobotWawancara = Kriteria::where('id', '=', 3)->first()->bobot_kriteria;
        //matriks terbobot Y diperoleh dari perkalian matriks normalisasi dengan bobot kriteria
        $kriteria = Kriteria::all();

        foreach($kriteria as $kriteria) {
        foreach ($this->mk as $calon) {
            $calon->y_file = $calon->normalisasiFile * $bobotFile;
            $calon->y_domisili = $calon->normalisasiDomisili * $bobotDomisili;
            $calon->y_surat = $calon->normalisasiSurat * $bobotSurat;
            $calon->y_tulisan = $calon->normalisasiTulisan * $bobotTulisan;
            $calon->y_wawancara = $calon->normalisasiWawancara * $bobotWawancara;
        }}

        //solusi ideal positif
        // artribut kriteria
        $atributFile = Kriteria::where('id', '=', 1)->first()->atribut_kriteria;
        $atributDomisili = Kriteria::where('id', '=', 4)->first()->atribut_kriteria;
        $atributSurat = Kriteria::where('id', '=', 5)->first()->atribut_kriteria;
        $atributTulisan = Kriteria::where('id', '=', 2)->first()->atribut_kriteria;
        $atributWawancara = Kriteria::where('id', '=', 3)->first()->atribut_kriteria;

        //solusi ideal positif, jika atribut kriteria benefit maka nilai max, jika cost maka nilai min
        // solusi ideal positif didapatkan dari nilai max atau min dari matriks terbobot Y
        // dimana jika atribut kriteria benefit maka nilai max, jika cost maka nilai min

        foreach($kriteria as $kriteria) {
        foreach ($this->mk as $calon) {
            $calon->max_file = $atributFile == 'benefit' ? $this->mk->max('y_file') : $this->mk->min('y_file');
            $calon->max_domisili = $atributDomisili == 'benefit' ? $this->mk->max('y_domisili') : $this->mk->min('y_domisili');
            $calon->max_surat = $atributSurat == 'benefit' ? $this->mk->max('y_surat') : $this->mk->min('y_surat');
            $calon->max_tulisan = $atributTulisan == 'benefit' ? $this->mk->max('y_tulisan') : $this->mk->min('y_tulisan');
            $calon->max_wawancara = $atributWawancara == 'benefit' ? $this->mk->max('y_wawancara') : $this->mk->min('y_wawancara');
        }}

        //solusi ideal negatif
        //solusi ideal negatif didapatkan dari nilai min atau max dari matriks terbobot Y
        // dimana jika atribut kriteria benefit maka nilai min, jika cost maka nilai max
        // foreach($kriteria as $kriteria) {
        // foreach ($this->mk as $calon) {
        //     $calon->min_file = $atributFile == 'benefit' ? $this->mk->min('y_file') : $this->mk->max('y_file');
        //     $calon->min_domisili = $atributDomisili == 'benefit' ? $this->mk->min('y_domisili') : $this->mk->max('y_domisili');
        //     $calon->min_surat = $atributSurat == 'benefit' ? $this->mk->min('y_surat') : $this->mk->max('y_surat');
        //     $calon->min_tulisan = $atributTulisan == 'benefit' ? $this->mk->min('y_tulisan') : $this->mk->max('y_tulisan');
        //     $calon->min_wawancara = $atributWawancara == 'benefit' ? $this->mk->min('y_wawancara') : $this->mk->max('y_wawancara');
        // }}

        // jarak solusi ideal positif (D+) dan solusi ideal negatif (D-)

        return view('livewire.data-perhitungan', [
            // 'item' => $this->item,
            'kriterias' => $this->kriterias,
            'alternatifs' => $this->alternatifs,
            'preferensi' => $this->preferensi,
            'jarak_positif' => $this->jarak_positif,
            'jarak_negatif' => $this->jarak_negatif,
            'alternatif_preferensi' => $this->alternatif_preferensi,
            'normalisasiDomisili' => $this->normalisasiDomisili,
            'normalisasiFile' => $this->normalisasiFile,
            'normalisasiSurat' => $this->normalisasiSurat,
            'normalisasiTulisan' => $this->normalisasiTulisan,
            'normalisasiWawancara' => $this->normalisasiWawancara,
            'y_file' => $this->y_file,
            'y_domisili' => $this->y_domisili,
            'y_surat' => $this->y_surat,
            'y_tulisan' => $this->y_tulisan,
            'y_wawancara' => $this->y_wawancara,
            'max_file' => $this->max_file,
            'max_domisili' => $this->max_domisili,
            'max_surat' => $this->max_surat,
            'max_tulisan' => $this->max_tulisan,
            'max_wawancara' => $this->max_wawancara,
            'min_file' => $this->min_file,
            'min_domisili' => $this->min_domisili,
            'min_surat' => $this->min_surat,
            'min_tulisan' => $this->min_tulisan,
            'min_wawancara' => $this->min_wawancara,
            'kriteria' => $this->kriteria,
            'mk' => $this->mk,
        ]);
    }

    public function store(){
        //validasi jumlah_layak
        $this->validate([
            'jumlah_layak' => 'required',
        ]);

        //simpan nilai preferensi ke database
        // keterangan "layak" <= jumlah_layak

        // foreach ($this->nilai_preferensi as $index => $nilai) {
        //     Rekomendasi::create([
        //         'alternatif_id' => $index,
        //         'nilai_preferensi' => $nilai,
        //         'keterangan' => $this->keterangan[$index] ?? 'tidak layak',
        //     ]);
        // }

        // keterangan layak <= jumlah_layak
        $mk = $this->mk->sortByDesc('nilai_preferensi');
        // dd($mk);

        $i = 0;
        foreach ($mk as $index => $calon) {
            $i++;
            Rekomendasi::create([
                'alternatif_id' => $calon->id, // Ganti dengan kolom yang sesuai untuk 'alternatif_id'
                'nilai_preferensi' => $this->nilai_preferensi[$index],
                'keterangan' => $i <= $this->jumlah_layak ? 'layak' : 'tidak layak',
            ]);
        }
        return redirect()->route('rekomendasi')->with('success', 'Data hasil perhitungan berhasil disimpan.');
    }

    public function saw(){
        $this->sawAktif = true;
        $this->topsisAktif = false;
    }
    public function topsis(){
        $this->sawAktif = false;
        $this->topsisAktif = true;
    }
}
