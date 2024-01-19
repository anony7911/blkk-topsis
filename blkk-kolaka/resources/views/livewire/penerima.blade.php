<div>
    <div class="content-wrapper">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Kelulusan</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Kelulusan</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <section class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="card">
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
                                                    <th>No HP</th>
                                                    <th>Email</th>
                                                    <th>
                                                        Tangal Lulus
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $no = 1;
                                                @endphp
                                                @forelse ($penerimas as $penerima)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $penerima->nama_jurusan }}</td>
                                                    <td>{{ $penerima->nama_calon }}</td>
                                                    <td>{{ $penerima->alamat_calon }}</td>
                                                    <td>{{ $penerima->no_hp_calon}}</td>
                                                    <td>{{ $penerima->email_calon}}</td>
                                                    <td>
                                                        {{ Carbon\Carbon::parse($penerima->deleted_at)->translatedFormat('d F Y') }}
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="7" class="text-center">Data Kosong</td>
                                                </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
</div>
