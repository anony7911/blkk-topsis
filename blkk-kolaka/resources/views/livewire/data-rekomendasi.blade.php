<div>
    <div class="card">
        <div class="card-header">
            @if(auth()->user()->role == 'admin')
            @if($rekomendasis->count() > 0)
            <h3 class="card-title"><button type="button" class="btn btn-md btn-danger" data-toggle="modal"
                    data-target="#modalReset"> <i class="fa fa-eraser" aria-hidden="true"></i>
                    Reset Rekomendasi</button>
            </h3>
            @else
            <h3 class="card-title"><a href="{{ url('/perhitungan') }}" type="button" class="btn btn-md btn-primary"> <i
                        class="fa fa-plus-circle" aria-hidden="true"></i>
                    Tambahkan Hasil Perhitungan</a>
            </h3>
            @endif
            @endif
        </div>
        <div class="card-body text-center">
            <div class="row">
                <div class="col-md-12">
                    @include('layouts._alert')
                </div>
                <div class="col-md-6 form-inline mb-2 mt-2">
                    Per Page: &nbsp;
                    <select wire:model="perPage" class="form-control">
                        <option>2</option>
                        <option>5</option>
                        <option>10</option>
                        <option>15</option>
                        <option>25</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <input wire:model.debounce.300ms="search" class="form-control" type="text" placeholder="Search...">
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-md-12 table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jurusan</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Nilai Preferensi</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no = 1;
                            @endphp
                            @forelse ($rekomendasis as $rekomendasi)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $rekomendasi->nama_jurusan}}</td>
                                <td>{{ $rekomendasi->nama_calon}}</td>
                                <td>{{ $rekomendasi->alamat_calon }}</td>
                                <td>{{ $rekomendasi->nilai_preferensi }}</td>
                                <td>{{ $rekomendasi->keterangan }}</td>
                                <td>
                                    {{-- PENERIMA --}}
                                    <button wire:click='delete({{ $rekomendasi->id }})' type="button"
                                        class="btn btn-sm btn-success" data-toggle="toltipe"
                                        title="Tandai Sebagai Penerima">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="modalReset" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reset Hasil Perhitungan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label>Apakah anda yakin melakukan reset?</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button wire:click.prevent="resetRekomendasi()" type="button" class="btn btn-danger"
                        data-dismiss="modal">Reset</button>
                </div>
            </div>
        </div>
    </div>
</div>
