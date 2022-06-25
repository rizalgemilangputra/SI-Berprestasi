<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_siswa', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_siswa');
            $table->smallInteger('kelas');
            $table->smallInteger('tahun_ajaran');
            $table->float('nilai_rerata')->nullable();
            $table->smallInteger('nilai_absensi')->nullable();
            $table->char('nilai_sikap', 1)->nullable();
            $table->char('nilai_ekstrakulikuler', 1)->nullable();
            $table->timestamps();

            $table->foreign('id_siswa')->references('id')->on('siswa')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_siswa');
    }
}
