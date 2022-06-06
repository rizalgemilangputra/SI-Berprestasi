<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $model = Siswa::orderBy('id', 'DESC');
        if (isset($request->cari) && !empty($request->cari)) {
            $students = Siswa::where('nama', 'like', '%'.$request->cari.'%')->orderBy('id', 'DESC')->paginate(10)->appends(['search' => $request->cari]);
        } else {
            $students = Siswa::orderBy('id', 'DESC')->paginate(10)->appends(['cari' => $request->cari]);
        }
        return view('siswa.index', compact('students'));
    }

    public function store(Request $request)
    {
        $rules = [
            'no_induk' => 'required',
            'nama' => 'required',
            'rerata_nilai' => 'required',
            'nilai_absensi' => 'required',
            'nilai_sikap' => 'required',
            'nilai_ekstrakulikuler' => 'required'
        ];

        $message = [
            'no_induk.required' => 'No. Induk tidak boleh kosong',
            'nama.required' => 'Nama tidak boleh kosong',
            'rerata_nilai.required' => 'Rerata Nilai tidak boleh kosong',
            'nilai_absensi.required' => 'Nilai Absensi tidak boleh kosong',
            'nilai_sikap.required' => 'Nilai Sikap tidak boleh kosong',
            'nilai_ekstrakulikuler.required' => 'Nilai Ekstrakulikuler tidak boleh kosong'
        ];

        request()->validate($rules,$message);

        Siswa::create([
            'no_induk' => $request->no_induk,
            'nama' => $request->nama,
            'rerata_nilai' => $request->rerata_nilai,
            'nilai_absensi' => $request->nilai_absensi,
            'nilai_sikap' => $request->nilai_sikap,
            'nilai_ekstrakulikuler' => $request->nilai_ekstrakulikuler,
        ]);

        return [
            'status'    => true,
            'message'   => 'Berhasil Menyimpan Data.',
            'data'      => []
        ];
    }
}
