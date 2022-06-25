<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'laporan';

    protected $fillable = ['tahun_ajaran', 'jenis'];

    public function detail()
    {
        return $this->hasMany(DetailLaporan::class, 'id_laporan', 'id');
    }
}
