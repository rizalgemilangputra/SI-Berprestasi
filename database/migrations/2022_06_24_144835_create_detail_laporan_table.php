<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailLaporanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_laporan', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_laporan');
            $table->unsignedInteger('id_siswa');
            $table->smallInteger('kelas');
            $table->float('nilai_preferensi')->default(0);
            $table->smallInteger('rank');
            $table->timestamps();

            $table->foreign('id_laporan')->references('id')->on('laporan')->cascadeOnDelete();
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
        Schema::dropIfExists('detail_laporan');
    }
}
