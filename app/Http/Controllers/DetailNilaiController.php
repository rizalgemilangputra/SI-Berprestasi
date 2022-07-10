<?php

namespace App\Http\Controllers;

use App\Models\DetailSiswa;
use Illuminate\Http\Request;

class DetailNilaiController extends Controller
{
    public function index(Request $request)
    {
        $students = [];

        if (isset($request->tahun_ajaran) && isset($request->kelas)) {
            if (isset($request->cari) && !empty($request->cari)) {
                $students = DetailSiswa::join('siswa', 'detail_siswa.id_siswa' , '=', 'siswa.id')
                    ->where('siswa.no_induk', 'like', $request->cari . '%')
                    ->where('detail_siswa.tahun_ajaran', $request->tahun_ajaran)
                    ->where('detail_siswa.kelas', $request->kelas)
                    ->where('detail_siswa.is_active', 1)
                    ->orderBy('siswa.no_induk', 'ASC')
                    ->paginate(10)->appends(['tahun_ajaran' => $request->tahun_ajaran , 'kelas' => $request->kelas, 'cari' => $request->cari]);
            } else {
                $students = DetailSiswa::join('siswa', 'detail_siswa.id_siswa' , '=', 'siswa.id')
                    ->where('detail_siswa.tahun_ajaran', $request->tahun_ajaran)
                    ->where('detail_siswa.kelas', $request->kelas)
                    ->where('detail_siswa.is_active', 1)
                    ->orderBy('siswa.no_induk', 'ASC')
                    ->paginate(10)->appends(['tahun_ajaran' => $request->tahun_ajaran , 'kelas' => $request->kelas, 'cari' => $request->cari]);
            }
        }

        return view('detail_nilai.index', compact('students'));
    }

    public function edit(Request $request, $no_induk, $tahun_ajaran, $kelas)
    {
        $student = DetailSiswa::join('siswa', 'detail_siswa.id_siswa', '=', 'siswa.id')
            ->where('siswa.no_induk', $no_induk)
            ->where('detail_siswa.tahun_ajaran', $tahun_ajaran)
            ->where('detail_siswa.kelas', $kelas)
            ->first();

        return view('detail_nilai.edit', compact('student'));
    }

    public function update(Request $request, $no_induk, $tahun_ajaran, $kelas)
    {
        $rules = [
            'nilai_rerata'          => 'required',
            'nilai_absensi'         => 'required',
            'nilai_sikap'           => 'required',
            'nilai_ekstrakulikuler' => 'required',
        ];

        $message = [
            'nilai_rerata.required'          => 'Nilai Rerata tidak boleh kosong',
            'nilai_absensi.required'         => 'Nilai Absensi tidak boleh kosong',
            'nilai_sikap.required'           => 'Nilai Sikap Nilai tidak boleh kosong',
            'nilai_ekstrakulikuler.required' => 'Nilai Ekstrakulikuler tidak boleh kosong',
        ];

        request()->validate($rules, $message);

        DetailSiswa::join('siswa', 'detail_siswa.id_siswa', '=', 'siswa.id')
            ->where('siswa.no_induk', $no_induk)
            ->where('detail_siswa.tahun_ajaran', $tahun_ajaran)
            ->where('detail_siswa.kelas', $kelas)
            ->update([
                'nilai_rerata'          => $request->nilai_rerata,
                'nilai_absensi'         => $request->nilai_absensi,
                'nilai_sikap'           => $request->nilai_sikap,
                'nilai_ekstrakulikuler' => $request->nilai_ekstrakulikuler,
            ]);

        $responseAlert = [
            'status_alert'  => 'success',
            'message_alert' => 'Berhasil Menambah Nilai Siswa'
        ];

        return redirect()->route('manage.detail_nilai', ['tahun_ajaran' => $tahun_ajaran, 'kelas' => $kelas])->with($responseAlert);
    }
}
