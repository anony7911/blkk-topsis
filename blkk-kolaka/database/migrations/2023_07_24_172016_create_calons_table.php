<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calons', function (Blueprint $table) {
            $table->id();
            $table->string('nama_calon');
            $table->string('alamat_calon');
            $table->string('no_hp_calon');
            $table->string('email_calon');
            $table->integer('jurusan_id');


            $table->unsignedBigInteger('file_id');
            $table->foreign('file_id')->references('id')->on('files');
            $table->unsignedBigInteger('tulisan_id');
            $table->foreign('tulisan_id')->references('id')->on('tulisans');
            $table->unsignedBigInteger('wawancara_id');
            $table->foreign('wawancara_id')->references('id')->on('wawancaras');
            $table->unsignedBigInteger('domisili_id');
            $table->foreign('domisili_id')->references('id')->on('domisilis');
            $table->unsignedBigInteger('surat_id');
            $table->foreign('surat_id')->references('id')->on('surats');
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
        Schema::dropIfExists('calons');
    }
}
