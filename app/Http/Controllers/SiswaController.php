<?php

namespace App\Http\Controllers;

use App\Models\DetailSiswa;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        if (isset($request->cari) && !empty($request->cari)) {
            $students = Siswa::where('no_induk', 'like', $request->cari . '%')->orderBy('no_induk', 'ASC')->paginate(10)->appends(['cari' => $request->cari]);
        } else {
            $students = Siswa::orderBy('no_induk', 'ASC')->paginate(10)->appends(['cari' => $request->cari]);
        }
        return view('siswa.index', compact('students'));
    }

    public function create(Request $request)
    {
        return view('siswa.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'no_induk'     => 'required',
            'nama'         => 'required',
            'tahun_ajaran' => 'required',
            'kelas'        => 'required',
        ];

        $message = [
            'no_induk.required'     => 'No. Induk tidak boleh kosong',
            'nama.required'         => 'Nama tidak boleh kosong',
            'tahun_ajaran.required' => 'Tahun Ajaran tidak boleh kosong',
            'kelas.required'        => 'Kelas tidak boleh kosong',
        ];

        request()->validate($rules, $message);

        $check_student = Siswa::where('no_induk', $request->no_induk)->count();
        if ($check_student > 0) {
            $responseAlert = [
                'status_alert'    => 'warning',
                'message_alert'   => 'Data Siswa Telah di input'
            ];

            return redirect()->route('manage.siswa.create')->withInput($request->all())->with($responseAlert);
        }

        $siswa = Siswa::create([
            'no_induk' => $request->no_induk,
            'nama'     => $request->nama,
        ]);

        DetailSiswa::create([
            'id_siswa'      => $siswa->id,
            'tahun_ajaran'  => $request->tahun_ajaran,
            'kelas'         => $request->kelas,
        ]);

        $responseAlert = [
            'status_alert'    => 'success',
            'message_alert'   => 'Berhasil Menambah Data Siswa'
        ];

        return redirect()->route('manage.siswa')->with($responseAlert);
    }

    public function edit(Request $request)
    {
        $student = Siswa::where('no_induk', $request->no_induk)->first();

        return view('siswa.edit', compact('student'));
    }

    public function update(Request $request)
    {
        $rules = [
            'nama' => 'required',
        ];

        $message = [
            'nama.required' => 'Nama tidak boleh kosong',
        ];

        request()->validate($rules, $message);

        Siswa::where('id', $request->id)->update([
            'nama' => $request->nama,
        ]);

        $responseAlert = [
            'status_alert'    => 'success',
            'message_alert'   => 'Berhasil Mengubah Data Siswa'
        ];

        return redirect()->route('manage.siswa')->with($responseAlert);
    }

    public function delete(Request $request)
    {
        Siswa::where('no_induk', $request->no_induk)->delete();

        $responseAlert = [
            'status_alert'    => 'success',
            'message_alert'   => 'Berhasil Menghapus Data Siswa'
        ];

        return redirect()->route('manage.siswa')->with($responseAlert);
    }

    public function detail(Request $request)
    {
        $student = Siswa::where('no_induk', $request->no_induk)->first();

        return view('siswa.detail', compact('student'));
    }
}
