@extends('layouts.template')
@section('content')
<div class="content-wrapper">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Selamat Datang, {{Auth::user()->name}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>


    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12 col-12 text-center">
                    <!-- <h1>SISTEM PENDUKUNG KEPUTUSAN PENENTUAN PENERIMA PROGRAM INDONESIA PINTAR (PIP) </h1> -->
                </div>
            </div>


            <div class="row">
            <div class="col-lg-12 col-12 text-center mt-4">
                <img src="{{asset('/kolaka.png')}}" alt="" width="200px" height="200px" class="mt-2 mb-4">
                    <h2>BLKK KOLAKA</h2>
                    <!-- <h2>PROGRAM INDONESIA PINTAR (PIP) </h2> -->
                    <!-- <h1 class="text-primary font-weight-bold">SD NEGERI 4 KOLAKAASI </h1> -->
                </div>
            </div>

        </div>
    </section>

</div>
@endsection
