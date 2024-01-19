<div>
    @php
        $i = 0;
        $j = 2;
        $k = 2;
        $l = 2;
        $m = 2;
        $n = 2;
        $o = 2;
        $p = 2;
        $yj = 2;
        $yk = 2;
        $yl = 2;
        $ym = 2;
        $yn = 2;
        $yo = 2;
        $yp = 2;
        $jp = 2;
        $jn = 2;
    @endphp
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
              Pilih Jurusan
            </h3>
        </div>
        <div class="card-body text-center">
            <div class="row mt-1">
                <select wire:model="idjurusan" class="form-control">
                    <option value="">-- Pilih Jurusan --</option>
                    @foreach($jurusan as $j)
                        <option value="{{ $j->id }}">{{ $j->nama_jurusan }}</option>
                    @endforeach
                </select>
                @error('idjurusan')
                    <div class="invalid-feedback text-white">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
    </div>
    @if ($jurusanAktif == true)
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Matriks Keputusan
            </h3>
        </div>
        <div class="card-body text-center">
            <div class="row mt-1">
                <div class="col-md-12 table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>Kelengkapan Berkas</th>
                                <th>Tes Tertulis</th>
                                <th>Wawancara</th>
                                <th>Domisili</th>
                                <th>Rekomendasi Desa/Kel.</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($mk as $alternatif)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $alternatif->nama_calon }}</td>
                                    <td>{{ $alternatif->bobot_file}}</td>
                                    <td>{{ $alternatif->bobot_tulisan}}</td>
                                    <td>{{ $alternatif->bobot_wawancara}}</td>
                                    <td>{{ $alternatif->bobot_domisili}}</td>
                                    <td>{{ $alternatif->bobot_surat}}</td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan="7">Belum ada data.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Matriks Ternormalisasi
            </h3>
        </div>
        <div class="card-body text-center">
            <div class="row mt-1">
                <div class="col-md-12 table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>Kelengkapan Berkas</th>
                                <th>Tes Tertulis</th>
                                <th>Wawancara</th>
                                <th>Domisili</th>
                                <th>Rekomendasi Desa/Kel.</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($mk as $index => $calon)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $calon->nama_calon }}</td>
                                <td>{{ $calon->normalisasiFile }}</td>
                                <td>{{ $calon->normalisasiTulisan }}</td>
                                <td>{{ $calon->normalisasiWawancara }}</td>
                                <td>{{ $calon->normalisasiDomisili }}</td>
                                <td>{{ $calon->normalisasiSurat }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">Belum ada data.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Matriks Normalisasi Terbobot
            </h3>
        </div>
        <div class="card-body text-center">
            <div class="row mt-1">
                <div class="col-md-12 table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>Kelengkapan Berkas</th>
                                <th>Tes Tertulis</th>
                                <th>Wawancara</th>
                                <th>Domisili</th>
                                <th>Rekomendasi Desa/Kel.</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($mk as $index => $calon)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $calon->nama_calon }}</td>
                                <td>{{ $calon->y_file }}</td>
                                <td>{{ $calon->y_tulisan }}</td>
                                <td>{{ $calon->y_wawancara}}</td>
                                <td>{{ $calon->y_domisili}}</td>
                                <td>{{ $calon->y_surat}}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">Belum ada data.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                Solusi Ideal Positif dan Negatif
            </h3>
        </div>
        <div class="card-body text-center">
            <div class="row mt-1">
                <div class="col-md-12 table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Kelengkapan Berkas</th>
                                <th>Tes Tertulis</th>
                                <th>Wawancara</th>
                                <th>Domisili</th>
                                <th>Rekomendasi Desa/Kel.</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @php
                                    $atributFile = \App\Models\Kriteria::where('id', '=', 1)->first()->atribut_kriteria;
                                    $atributDomisili = \App\Models\Kriteria::where('id', '=', 4)->first()->atribut_kriteria;
                                    $atributSurat = \App\Models\Kriteria::where('id', '=', 5)->first()->atribut_kriteria;
                                    $atributTulisan = \App\Models\Kriteria::where('id', '=', 2)->first()->atribut_kriteria;
                                    $atributWawancara = \App\Models\Kriteria::where('id', '=', 3)->first()->atribut_kriteria;
                                @endphp
                                <td>Positif</td>
                                <td>
                                    @if ($atributFile == 'cost')
                                        {{ $mk->min('y_file') }}
                                    @else
                                        {{ $mk->max('y_file') }}
                                    @endif
                                </td>
                                <td>
                                    @if ($atributTulisan == 'cost')
                                        {{ $mk->min('y_tulisan') }}
                                    @else
                                        {{ $mk->max('y_tulisan') }}
                                    @endif
                                </td>
                                <td>
                                    @if ($atributWawancara == 'cost')
                                        {{ $mk->min('y_wawancara') }}
                                    @else
                                        {{ $mk->max('y_wawancara') }}
                                    @endif
                                </td>
                                <td>
                                    @if ($atributDomisili == 'cost')
                                        {{ $mk->min('y_domisili') }}
                                    @else
                                        {{ $mk->max('y_domisili') }}
                                    @endif
                                </td>
                                <td>
                                    @if ($atributSurat == 'cost')
                                        {{ $mk->min('y_surat') }}
                                    @else
                                        {{ $mk->max('y_surat') }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Negatif</td>
                                <td>
                                    @if ($atributFile == 'benefit')
                                    {{ $mk->min('y_file') }}
                                    @else
                                    {{ $mk->max('y_file') }}
                                    @endif
                                </td>
                                <td>
                                    @if ($atributTulisan == 'benefit')
                                    {{ $mk->min('y_tulisan') }}
                                    @else
                                    {{ $mk->max('y_tulisan') }}
                                    @endif
                                </td>
                                <td>
                                    @if ($atributWawancara == 'benefit')
                                    {{ $mk->min('y_wawancara') }}
                                    @else
                                    {{ $mk->max('y_wawancara') }}
                                    @endif
                                </td>
                                <td>
                                    @if ($atributDomisili == 'benefit')
                                    {{ $mk->min('y_domisili') }}
                                    @else
                                    {{ $mk->max('y_domisili') }}
                                    @endif
                                </td>
                                <td>
                                    @if ($atributSurat == 'benefit')
                                    {{ $mk->min('y_surat') }}
                                    @else
                                    {{ $mk->max('y_surat') }}
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
               Jarak Positif (D+), Jarak Negatif (D-) & Nilai Preferensi
            </h3>
        </div>
        <div class="card-body text-center">
            <div class="row mt-1">
                <div class="col-md-12 table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>D+</th>
                                <th>D-</th>
                                <th>Preferensi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $d_plus = [];
                                $d_min = [];
                            @endphp

                            @forelse ($mk as $index => $calon)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $calon->nama_calon }}</td>
                                <td>
                                    @php
                                        $d_plus[$index] = sqrt(
                                            pow(($calon->y_file - $mk->max('y_file')), 2) +
                                            pow(($calon->y_tulisan - $mk->max('y_tulisan')), 2) +
                                            pow(($calon->y_wawancara - $mk->max('y_wawancara')), 2) +
                                            pow(($calon->y_domisili - $mk->max('y_domisili')), 2) +
                                            pow(($calon->y_surat - $mk->max('y_surat')), 2)
                                        );
                                        echo $d_plus[$index];
                                    @endphp
                                </td>
                                <td>
                                    @php
                                        $d_min[$index] = sqrt(
                                            pow(($calon->y_file - $mk->min('y_file')), 2) +
                                            pow(($calon->y_tulisan - $mk->min('y_tulisan')), 2) +
                                            pow(($calon->y_wawancara - $mk->min('y_wawancara')), 2) +
                                            pow(($calon->y_domisili - $mk->min('y_domisili')), 2) +
                                            pow(($calon->y_surat - $mk->min('y_surat')), 2)
                                        );
                                        echo $d_min[$index];
                                    @endphp
                                </td>
                                <td>
                                    @php
                                        $nilai_preferensi[$index] = $d_min[$index] / ($d_min[$index] + $d_plus[$index]);

                                        $this->nilai_preferensi[$index] = $nilai_preferensi[$index];
                                    @endphp
                                    {{ $nilai_preferensi[$index] }}
                                    <!-- <input wire:model='nilai_preferensi.{{ $index }}' type="hidden" value="{{ $nilai_preferensi[$index] }}"> -->
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">Belum ada data.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            {{-- input jumlah layak --}}
            <div class="row mt-1">
                <div class="col-md-12 bg-secondary">
                    <div class="form-group text-left">
                        <label class="text-lg" for="jumlah_layak">Masukkan Jumlah Kuota</label>
                        <input type="number" wire:model='jumlah_layak'
                            class="form-control @error('jumlah_layak') is-invalid @enderror"
                            value="{{ old('jumlah_layak') }}">
                        @error('jumlah_layak')
                            <div class="invalid-feedback text-white">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <button type="submit" wire:click.prevent="store()" class="btn btn-primary btn-block mb-2 mt-4">
                    Simpan Hasil Perhitungan
                </button>
            </div>
        </div>
    </div>
    @endif
</div>
