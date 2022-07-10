<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSiswa extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'detail_siswa';

    protected $fillable = ['id_siswa', 'tahun_ajaran', 'kelas', 'nilai_rerata', 'nilai_absensi', 'nilai_sikap', 'nilai_ekstrakulikuler'];

    public function siswa()
    {
        return $this->hasOne(Siswa::class, 'id', 'id_siswa');
    }

    public static function getLastId()
    {
        $detail = DetailSiswa::orderBy('id', 'DESC')->first('id');
        return $detail->id;
    }
}
