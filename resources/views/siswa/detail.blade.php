@extends('layouts.app')

@section('title', 'Detail Data Siswa')

@section('content')
    <div class="card p-4">
        <div class="form-group">
            <label for="no_induk">No. Induk</label>
            <input type="text" class="form-control" id="no_induk" name="no_induk" value="{{ $student->no_induk }}" placeholder="No. Induk" disabled>
        </div>

        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="{{ $student->nama }}" disabled>
        </div>
    </div>

    @foreach ($student->detail as $detail)
        <div class="card">

            <div class="card-header">
                <div><span class="fw-bold">Tahun Ajaran : </span> {{ App\Models\TahunAjaran::$tahun_ajaran[$detail->tahun_ajaran] }}</div>
                <div><span class="fw-bold">Kelas : </span> {{ App\Models\Kelas::$kelas[$detail->kelas] }}</div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped mb-0">
                        <thead>
                            <tr>
                                <th>Nilai Rerata</th>
                                <th>Nilai Absensi</th>
                                <th>Nilai Sikap</th>
                                <th>Nilai Ekstrakulikuler</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $detail->nilai_rerata }}</td>
                                <td>{{ $detail->nilai_absensi }}</td>
                                <td>{{ $detail->nilai_sikap }}</td>
                                <td>{{ $detail->nilai_ekstrakulikuler }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endforeach
@endsection
