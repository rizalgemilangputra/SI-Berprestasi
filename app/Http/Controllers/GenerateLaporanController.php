<?php

namespace App\Http\Controllers;

use App\Models\DetailLaporan;
use App\Models\DetailSiswa;
use App\Models\Kelas;
use App\Models\Laporan;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GenerateLaporanController extends Controller
{
    public function index(Request $request)
    {
        $reports = [];

        if (isset($request->jenis) && isset($request->tahun_ajaran)) {
            $reports = Laporan::where('laporan.tahun_ajaran', $request->tahun_ajaran)
                    ->where('laporan.jenis', $request->jenis)
                    ->paginate(10)
                    ->appends(['jenis' => $request->jenis, 'tahun_ajaran' => $request->tahun_ajaran, 'kelas' => $request->kelas]);
        }

        return view('generate_laporan.index', compact('reports'));
    }

    public function generate(Request $request)
    {

        $check = DetailSiswa::where('tahun_ajaran', $request->tahun_ajaran)->where('is_active', 1)->get();
        if (!$check) {
            $responseAlert = [
                'status_alert' => 'warning',
                'message_alert' => "Data siswa tidak ada!"
            ];

            return redirect()->route('manage.generate_laporan')->with($responseAlert);
        }

        foreach ($check as $data) {
            if (!isset($data->nilai_rerata) || !isset($data->nilai_absensi) || !isset($data->nilai_sikap)) {
                $responseAlert = [
                    'status_alert' => 'warning',
                    'message_alert' => "Data nilai siswa belum lengkap"
                ];

                return redirect()->route('manage.generate_laporan')->with($responseAlert);
            }
        }



        DB::beginTransaction();
        try {
            $check = Laporan::where('tahun_ajaran', $request->tahun_ajaran)->count();
            if ($check > 0) {
                Laporan::where('tahun_ajaran', $request->tahun_ajaran)->delete();
            }

            $this->perTahunAjaran($request);
            $this->perKelas($request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return $e;
        }

        $tahun_ajaran = TahunAjaran::$tahun_ajaran[$request->tahun_ajaran];

        $responseAlert = [
            'status_alert' => 'success',
            'message_alert' => "Berhasil Generate laporan tahun ajaran : {$tahun_ajaran}"
        ];

        return redirect()->route('manage.generate_laporan')->with($responseAlert);
    }

    private function perTahunAjaran($request)
    {

        $data = DetailSiswa::join('siswa', 'detail_siswa.id_siswa', '=' , 'siswa.id')
            ->where('detail_siswa.tahun_ajaran', $request->tahun_ajaran)
            ->where('detail_siswa.is_active', 1)
            ->get();

        if (!$data->isEmpty()) {
            $result = $this->process($data);

            $report_tahun_ajaran = Laporan::create([
                'tahun_ajaran'  => $request->tahun_ajaran,
                'jenis'         => 'tahun_ajaran'
            ]);

            foreach ($result as $detail) {
                DetailLaporan::create([
                    'id_laporan'        => $report_tahun_ajaran->id,
                    'id_siswa'          => $detail['id_siswa'],
                    'kelas'             => $detail['kelas'],
                    'nilai_preferensi'  => $detail['v'],
                    'rank'              => $detail['rank']
                ]);
            }
        }
    }

    private function perKelas($request)
    {

        $classes = Kelas::$kelas;

        foreach ($classes as $key => $class) {
            $data = DetailSiswa::join('siswa', 'detail_siswa.id_siswa', '=' , 'siswa.id')
            ->where('detail_siswa.tahun_ajaran', $request->tahun_ajaran)
            ->where('detail_siswa.kelas', $key)
            ->where('detail_siswa.is_active', 1)
            ->get();

            Log::info($data);

            if (!$data->isEmpty()) {
                $result = $this->process($data);

                $report_tahun_ajaran = Laporan::create([
                    'tahun_ajaran'  => $request->tahun_ajaran,
                    'jenis'         => 'kelas'
                ]);

                foreach ($result as $detail) {
                    DetailLaporan::create([
                        'id_laporan'        => $report_tahun_ajaran->id,
                        'id_siswa'          => $detail['id_siswa'],
                        'kelas'             => $detail['kelas'],
                        'nilai_preferensi'  => $detail['v'],
                        'rank'              => $detail['rank']
                    ]);
                }
            }
        }
    }

    private function process($students)
    {
        $alternatif = [];

        foreach ($students as $student) {
            $alternatif[] = [
                'id_siswa'  => $student->id_siswa,
                'kelas'     => $student->kelas,
                'c1'        => $this->setPoint($student->nilai_rerata, 'rerata'),
                'c2'        => $this->setPoint($student->nilai_absensi, 'absensi'),
                'c3'        => $this->setPoint($student->nilai_sikap, 'sikap'),
                'c4'        => $this->setPoint($student->nilai_ekstrakulikuler, 'ekstra')
            ];
        }

        $c1     = array_column($alternatif, 'c1');
        $max_c1 = max($c1);
        $c2     = array_column($alternatif, 'c2');
        $max_c2 = max($c2);
        $c3     = array_column($alternatif, 'c3');
        $max_c3 = max($c3);
        $c4     = array_column($alternatif, 'c4');
        $max_c4 = max($c4);

        foreach ($alternatif as $key => $detail) {
            if ($max_c1 != 0 && $detail['c1'] != 0) {
                $alternatif[$key]['r1'] = $detail['c1'] / $max_c1;
            } else {
                $alternatif[$key]['r1'] = 0;
            }

            if ($max_c2 != 0 && $detail['c2'] != 0) {
                $alternatif[$key]['r2'] = $detail['c2'] / $max_c2;
            } else {
                $alternatif[$key]['r2'] = 0;
            }

            if ($max_c3 != 0 && $detail['c3'] != 0) {
                $alternatif[$key]['r3'] = $detail['c3'] / $max_c3;
            } else {
                $alternatif[$key]['r3'] = 0;
            }

            if ($max_c4 != 0 && $detail['c4'] != 0) {
                $alternatif[$key]['r4'] = $detail['c4'] / $max_c4;
            } else {
                $alternatif[$key]['r4'] = 0;
            }
        }

        foreach ($alternatif as $key => $detail) {
            $alternatif[$key]['v'] = ($detail['r1'] * 0.55) + ($detail['r1'] * 0.2) + ($detail['r1'] * 0.15) + ($detail['r1'] * 0.1);
            $sort = $alternatif[$key]['v'];
        }

        $result = $this->setRank($alternatif);

        return $result;
    }

    private function setRank($students)
    {

        usort($students, function($a, $b) {return $a['v'] < $b['v'];});

        $rank = 0;
		$count = 1;
        foreach ($students as $key => $student) {
            if ($key == 0) {
                $rank = 1;
                $students[$key]['rank'] = $rank;
                continue;
            }

            if ($student['v'] == $students[$key-1]['v']) {
                if ($count < 3 ) {
					$rank = $rank;
					$count++;
					$students[$key]['rank'] = $rank;
				} else {
					$rank++;
					$count = 1;
					$students[$key]['rank'] = $rank;
				}
            } else {
                $rank++;
				$count = 1;
                $students[$key]['rank'] = $rank;
            }
        }

        return $students;
    }

    private function setPoint($nilai, $type)
    {
        if ($type == 'sikap') {
            switch ($nilai) {
                case 'A':
                    return 5;
                    break;
                case 'B':
                    return 4;
                    break;
                case 'C':
                    return 3;
                    break;
                case 'D':
                    return 2;
                    break;
                case 'E':
                    return 1;
                    break;
                default:
                    return 0;
                    break;
            }
        } else if ($type == 'ekstra') {
            switch ($nilai) {
                case 'A':
                    return 5;
                    break;
                case 'B':
                    return 4;
                    break;
                case 'C':
                    return 3;
                    break;
                case 'D':
                    return 2;
                    break;
                case 'E':
                    return 1;
                    break;
                default:
                    return 0;
                    break;
            }
        } else if ($type == 'rerata') {
            switch ($nilai) {
                case $nilai >= 90:
                    return 5;
                    break;
                case $nilai >= 80 && $nilai <= 89:
                    return 4;
                    break;
                case $nilai >= 70 && $nilai <= 79:
                    return 3;
                    break;
                case $nilai >= 51 && $nilai <= 69:
                    return 2;
                    break;
                case $nilai < 50:
                    return 1;
                    break;
                default:
                    return 0;
                    break;
            }
        } else if ($type == 'absensi') {
            switch ($nilai) {
                case $nilai < 5:
                    return 5;
                    break;
                case $nilai >= 6 && $nilai <= 10:
                    return 4;
                    break;
                case $nilai >= 11 && $nilai <= 15:
                    return 3;
                    break;
                case $nilai >= 16 && $nilai <= 20:
                    return 2;
                    break;
                case $nilai > 20:
                    return 1;
                    break;
                default:
                    return 0;
                    break;
            }
        }
    }
}
