<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // simpan ke tabel files
        $file = [[
            'nama_file' => 'Lengkap',
        ], [
            'nama_file' => 'Tidak Lengkap',
        ]];

        foreach($file as $file){
            \App\Models\File::create($file);
        };

        // simpan ke tabel tulisans
        $tulisan = [[
            'nama_tulisan' => '0 - 50 (Predikat E)',
        ], [
            'nama_tulisan' => '51 - 60 (Predikat D)',
        ], [
            'nama_tulisan' => '61 - 70 (Predikat C)',
        ], [
            'nama_tulisan' => '71 - 80 (Predikat B)',
        ], [
            'nama_tulisan' => '81 - 100 (Predikat A)',
        ]];

        foreach($tulisan as $tulisan){
            \App\Models\Tulisan::create($tulisan);
        };

        // simpan ke tabel wawancaras
        $wawancara = [[
            'nama_wawancara' => '0 - 50 (Predikat E)',
        ], [
            'nama_wawancara' => '51 - 60 (Predikat D)',
        ], [
            'nama_wawancara' => '61 - 70 (Predikat C)',
        ], [
            'nama_wawancara' => '71 - 80 (Predikat B)',
        ], [
            'nama_wawancara' => '81 - 100 (Predikat A)',
        ]];

        foreach($wawancara as $wawancara){
            \App\Models\Wawancara::create($wawancara);
        };

        // simpan ke tabel domisilis
        $domisili = [[
            'nama_domisili' => 'Kolaka',
        ], [
            'nama_domisili' => 'Luar Kolaka',
        ]];

        foreach($domisili as $domisili){
            \App\Models\Domisili::create($domisili);
        };

        // simpan ke tabel surats
        $surat = [[
            'nama_surat' => 'Ada',
        ], [
            'nama_surat' => 'Tidak Ada',
        ]];

        foreach($surat as $surat){
            \App\Models\Surat::create($surat);
        };

        // simpan ke tabel jurusans di BLKK Kolaka
        $jurusan = [[
            'nama_jurusan' => 'Teknik Listrik',
        ], [
            'nama_jurusan' => 'Pengelola Administrasi Perkantoran',
        ], [
            'nama_jurusan' => 'Bisnis Management',
        ], [
            'nama_jurusan' => 'Basic Office',
        ],[
            'nama_jurusan' => 'Processing (Pembuatan Kue dan Roti)',
        ],[
            'nama_jurusan' => 'Pengelasan',
        ],[
            'nama_jurusan' => 'Asisten Pembuat Pakaian (Menjahit)',
        ],[
            'nama_jurusan' => 'Juru Ukur (Surveyor)',
        ],[
            'nama_jurusan' => 'Desain Grafis Muda',
        ],[
            'nama_jurusan' => 'Servis AC',
        ],[
            'nama_jurusan' => 'Servis Sepeda Motor Injeksi',
        ],[
            'nama_jurusan' => 'Menggambar Kontruksi Bangunan (AutoCAD)',
        ],[
            'nama_jurusan' => 'Servis Sepeda Motor Matic',
        ]];

        foreach($jurusan as $jurusan){
            \App\Models\Jurusan::create($jurusan);
        };

        // simpan ke tabel calons
        $calon = [[
            'nama_calon' => 'Muhammad Rizky',
            'alamat_calon' => 'Kolaka',
            'no_hp_calon' => '085343434343',
            'email_calon' => 'risky@gmail.com',
            'jurusan_id' => '1',
            'file_id' => '1',
            'tulisan_id' => '1',
            'wawancara_id' => '1',
            'domisili_id' => '1',
            'surat_id' => '1',
        ], [
            'nama_calon' => 'Ramlan',
            'alamat_calon' => 'Luar Kolaka',
            'no_hp_calon' => '085323456323',
            'email_calon' => 'ramlan@gmail.com',
            'jurusan_id' => '2',
            'file_id' => '2',
            'tulisan_id' => '2',
            'wawancara_id' => '2',
            'domisili_id' => '2',
            'surat_id' => '2',
        ]];

        foreach($calon as $calon){
            \App\Models\Calon::create($calon);
        };
    }
}
