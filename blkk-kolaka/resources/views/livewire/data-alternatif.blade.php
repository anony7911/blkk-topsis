<div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#modalTambah"> <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    Data Alternatif</button>
            </h3>
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
                                <th>Nama Lengkap</th>
                                <th>Jurusan</th>
                                <th>Berkas</th>
                                <th>Tes Tertulis</th>
                                <th>Wawancara</th>
                                <th>Domisili</th>
                                <th>Rekomendasi Desa/Kel.</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alternatifs as $alternatif)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $alternatif->nama_calon }}</td>
                                <td>{{ $alternatif->nama_jurusan}}</td>
                                <td>{{ $alternatif->nama_file}}</td>
                                <td>{{ $alternatif->nama_tulisan}}</td>
                                <td>{{ $alternatif->nama_wawancara}}</td>
                                <td>{{ $alternatif->nama_domisili}}</td>
                                <td>{{ $alternatif->nama_surat}}</td>
                                <td>
                                    <button wire:click="alternatifId({{ $alternatif->id }})" class="btn btn-sm btn-warning m-1" data-toggle="modal" data-target="#modalEdit">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Alternatif</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label>Nama Lengkap</label>
                        <input wire:model="nama_calon" type="text" class="form-control @error('nis') is-invalid @enderror">
                        @error('nis')<div class="invalid-feedback">{{ $message }}
                        </div>@enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Alamat</label>
                        <textarea wire:model="alamat_calon" type="text" class="form-control @error('alamat_calon') is-invalid @enderror"></textarea>
                        @error('alamat_calon')<div class="invalid-feedback">{{ $message }}
                        </div>@enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>No WhatsApp</label>
                        <input wire:model="no_hp_calon" type="text" class="form-control @error('no_hp_calon') is-invalid @enderror">
                        @error('no_hp_calon')<div class="invalid-feedback">{{ $message }}
                        </div>@enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Email</label>
                        <input wire:model="email_calon" type="email" class="form-control @error('email_calon') is-invalid @enderror">
                        @error('email_calon')<div class="invalid-feedback">{{ $message }}
                        </div>@enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Jurusan</label>
                        <select class="form-control" wire:model="jurusan_id">
                            <option value="" hidden>-- Pilih --</option>
                            @foreach ($jurusans as $jurusan)
                            <option value="{{ $jurusan->id }}">{{ $jurusan->nama_jurusan }}</option>
                            @endforeach
                        </select>
                        @error('jurusan_id')<div class="invalid-feedback">{{ $message }}
                        </div>@enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Berkas</label>
                        <select class="form-control" wire:model="file_id">
                            <option value="" hidden>-- Pilih --</option>
                            @foreach ($files as $file)
                            <option value="{{ $file->id }}">{{ $file->nama_file }}</option>
                            @endforeach
                        </select>
                        @error('file_id')<div class="invalid-feedback">{{ $message }}
                        </div>@enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Tes Tertulis</label>
                        <select class="form-control" wire:model="tulisan_id">
                            <option value="" hidden>-- Pilih --</option>
                            @foreach ($tulisans as $tulisan)
                            <option value="{{ $tulisan->id }}">{{ $tulisan->nama_tulisan }}</option>
                            @endforeach
                        </select>
                        @error('tulisan_id')<div class="invalid-feedback">{{ $message }}
                        </div>@enderror
                    </div>

                    <div class="form-group mb-2">
                        <label>Wawancara</label>
                        <select class="form-control" wire:model="wawancara_id">
                            <option value="" hidden>-- Pilih --</option>
                            @foreach ($wawancaras as $wawancara)
                            <option value="{{ $wawancara->id }}">{{ $wawancara->nama_wawancara }}</option>
                            @endforeach
                        </select>
                        @error('wawancara_id')<div class="invalid-feedback">{{ $message }}
                        </div>@enderror
                    </div>

                    <div class="form-group mb-2">
                        <label>Rekomendasi Desa/Kel.</label>
                        <select class="form-control" wire:model="surat_id">
                            <option value="" hidden>-- Pilih --</option>
                            @foreach ($surats as $surat)
                            <option value="{{ $surat->id }}">{{ $surat->nama_surat }}</option>
                            @endforeach
                        </select>
                        @error('surat_id')<div class="invalid-feedback">{{ $message }}
                        </div>@enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Domisili</label>
                        <select class="form-control" wire:model="domisili_id">
                            <option value="" hidden>-- Pilih --</option>
                            @foreach ($domisilis as $domisili)
                            <option value="{{ $domisili->id }}">{{ $domisili->nama_domisili }}</option>
                            @endforeach
                        </select>
                        @error('domisili_id')<div class="invalid-feedback">{{ $message }}
                        </div>@enderror
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal" data-dismiss="modal">Close</button>
                    <button type="submit" wire:click.prevent="store()" class="btn btn-info close-modal" data-dismiss="modal">Tambah</button>
                </div>
            </div>
        </div>
    </div>
    <div wire:ignore.self class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Alternatif</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label>Nama Lengkap</label>
                        <input wire:model="nama_calon" type="text" class="form-control @error('nis') is-invalid @enderror">
                        @error('nis')<div class="invalid-feedback">{{ $message }}
                        </div>@enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Alamat</label>
                        <textarea wire:model="alamat_calon" type="text" class="form-control @error('alamat_calon') is-invalid @enderror"></textarea>
                        @error('alamat_calon')<div class="invalid-feedback">{{ $message }}
                        </div>@enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>No WhatsApp</label>
                        <input wire:model="no_hp_calon" type="text" class="form-control @error('no_hp_calon') is-invalid @enderror">
                        @error('no_hp_calon')<div class="invalid-feedback">{{ $message }}
                        </div>@enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Email</label>
                        <input wire:model="email_calon" type="email" class="form-control @error('email_calon') is-invalid @enderror">
                        @error('email_calon')<div class="invalid-feedback">{{ $message }}
                        </div>@enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Jurusan</label>
                        <select class="form-control" wire:model="jurusan_id">
                            <option value="" hidden>-- Pilih --</option>
                            @foreach ($jurusans as $jurusan)
                            <option value="{{ $jurusan->id }}">{{ $jurusan->nama_jurusan }}</option>
                            @endforeach
                        </select>
                        @error('jurusan_id')<div class="invalid-feedback">{{ $message }}
                        </div>@enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Berkas</label>
                        <select class="form-control" wire:model="file_id">
                            <option value="" hidden>-- Pilih --</option>
                            @foreach ($files as $file)
                            <option value="{{ $file->id }}">{{ $file->nama_file }}</option>
                            @endforeach
                        </select>
                        @error('file_id')<div class="invalid-feedback">{{ $message }}
                        </div>@enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Tes Tertulis</label>
                        <select class="form-control" wire:model="tulisan_id">
                            <option value="" hidden>-- Pilih --</option>
                            @foreach ($tulisans as $tulisan)
                            <option value="{{ $tulisan->id }}">{{ $tulisan->nama_tulisan }}</option>
                            @endforeach
                        </select>
                        @error('tulisan_id')<div class="invalid-feedback">{{ $message }}
                        </div>@enderror
                    </div>

                    <div class="form-group mb-2">
                        <label>Wawancara</label>
                        <select class="form-control" wire:model="wawancara_id">
                            <option value="" hidden>-- Pilih --</option>
                            @foreach ($wawancaras as $wawancara)
                            <option value="{{ $wawancara->id }}">{{ $wawancara->nama_wawancara }}</option>
                            @endforeach
                        </select>
                        @error('wawancara_id')<div class="invalid-feedback">{{ $message }}
                        </div>@enderror
                    </div>

                    <div class="form-group mb-2">
                        <label>Rekomendasi Desa/Kel.</label>
                        <select class="form-control" wire:model="surat_id">
                            <option value="" hidden>-- Pilih --</option>
                            @foreach ($surats as $surat)
                            <option value="{{ $surat->id }}">{{ $surat->nama_surat }}</option>
                            @endforeach
                        </select>
                        @error('surat_id')<div class="invalid-feedback">{{ $message }}
                        </div>@enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Domisili</label>
                        <select class="form-control" wire:model="domisili_id">
                            <option value="" hidden>-- Pilih --</option>
                            @foreach ($domisilis as $domisili)
                            <option value="{{ $domisili->id }}">{{ $domisili->nama_domisili }}</option>
                            @endforeach
                        </select>
                        @error('domisili_id')<div class="invalid-feedback">{{ $message }}
                        </div>@enderror
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal" data-dismiss="modal">Close</button>
                    <button type="submit" wire:click.prevent="update()" class="btn btn-info close-modal" data-dismiss="modal">Update</button>
                </div>
            </div>
        </div>
    </div>

</div>
