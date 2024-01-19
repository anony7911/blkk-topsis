<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlternatifsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alternatifs', function (Blueprint $table) {
            $table->id();
            $table->integer('nis');
            $table->string('nama_lengkap');
            $table->string('kelas');
            $table->integer('pekerjaan_ortu');
            $table->integer('penghasilan_ortu');
            $table->integer('jumlah_tanggungan');
            $table->integer('status_anak');
            $table->integer('pemegang_kks');
            $table->integer('pemegang_pkh');
            $table->integer('pemegang_sktm');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alternatifs');
    }
}
