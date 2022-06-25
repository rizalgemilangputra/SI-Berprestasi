<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailLaporan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'detail_laporan';

    protected $fillable = ['id_laporan', 'id_siswa', 'kelas', 'nilai_preferensi', 'rank'];

    public function laporan()
    {
        return $this->hasOne(Laporan::class, 'id', 'id_laporan');
    }
}
