<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $reports = [];

        if (isset($request->jenis) && isset($request->tahun_ajaran)) {

            if ($request->jenis == 'tahun_ajaran') {
                $reports = Laporan::join('detail_laporan', 'laporan.id', '=' , 'detail_laporan.id_laporan')
                    ->join('siswa', 'detail_laporan.id_siswa', '=' , 'siswa.id')
                    ->join('detail_siswa', function($sql){
                        $sql->on('siswa.id', 'detail_siswa.id_siswa');
                        $sql->on('detail_siswa.kelas', 'detail_laporan.kelas');
                    })
                    ->where('laporan.jenis', $request->jenis)
                    ->where('laporan.tahun_ajaran', $request->tahun_ajaran)
                    ->orderBy('detail_laporan.rank', 'ASC')
                    ->paginate(10)->appends(['jenis' => $request->jenis, 'tahun_ajaran' => $request->tahun_ajaran, 'kelas' => $request->kelas]);

            } else if ($request->jenis == 'kelas') {
                $reports = Laporan::join('detail_laporan', 'laporan.id', '=' , 'detail_laporan.id_laporan')
                    ->join('siswa', 'detail_laporan.id_siswa', '=' , 'siswa.id')
                    ->join('detail_siswa', 'siswa.id', 'detail_siswa.id_siswa')
                    ->where('laporan.jenis', $request->jenis)
                    ->where('laporan.tahun_ajaran', $request->tahun_ajaran)
                    ->where('detail_laporan.kelas', $request->kelas)
                    ->orderBy('detail_laporan.rank', 'ASC')
                    ->paginate(10)->appends(['jenis' => $request->jenis, 'tahun_ajaran' => $request->tahun_ajaran, 'kelas' => $request->kelas]);
            }

        }

        return view('laporan.index', compact('reports'));
    }
}
