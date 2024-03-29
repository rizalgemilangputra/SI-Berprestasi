<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'siswa';

    protected $fillable = ['no_induk', 'nama'];

    public function detail()
    {
        return $this->hasMany(DetailSiswa::class, 'id_siswa', 'id');
    }
}
