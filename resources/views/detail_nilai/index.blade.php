@extends('layouts.app')

@section('title', 'Detail Nilai Siswa')

@section('content')
    <section class="section">
        <div class="row" id="table-striped">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <form action="{{ route('manage.detail_nilai') }}" method="GET">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <select class="form-select" required name="tahun_ajaran">
                                                <option selected>Pilih Tahun Ajaran</option>
                                                <option value="1" {{ Request::get('tahun_ajaran') == 1 ? 'selected' : ''}}>2021/2022</option>
                                                <option value="2" {{ Request::get('tahun_ajaran') == 2 ? 'selected' : ''}}>2022/2023</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <select class="form-select" name="kelas" required>
                                                <option selected>Pilih Kelas</option>
                                                <option value="1" {{ Request::get('kelas') == 1 ? 'selected' : ''}}>Kelas 7</option>
                                                <option value="2" {{ Request::get('kelas') == 2 ? 'selected' : ''}}>Kelas 8</option>
                                                <option value="2" {{ Request::get('kelas') == 3 ? 'selected' : ''}}>Kelas 9</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row d-flex flex-row-reverse">
                                        <div class="col-6">
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" placeholder="Cari No. Induk Siswa"
                                                    aria-label="Cari No. Induk Siswa" aria-describedby="basic-addon2" name="cari" value="{{ Request::get('cari') }}">
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-primary">Cari</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="card-content px-4 pb-4">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No. Induk</th>
                                        <th>Nama</th>
                                        <th class="text-end">Nilai Rerata</th>
                                        <th class="text-end">Nilai Absensi</th>
                                        <th class="text-center">Nilai Sikap</th>
                                        <th class="text-center">Nilai Ekstrakulikuler</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-bold-500">{{ $student->no_induk }}</td>
                                            <td>{{ $student->nama }}</td>
                                            <td class="text-end">{{ $student->nilai_rerata }}</td>
                                            <td class="text-end">{{ $student->nilai_absensi }}</td>
                                            <td class="text-center">{{ $student->nilai_sikap }}</td>
                                            <td class="text-center">{{ $student->nilai_ekstrakulikuler }}</td>
                                            <td><a href="{{ route('manage.detail_nilai.edit', ['no_induk' => $student->no_induk, 'tahun_ajaran' => $student->tahun_ajaran, 'kelas' => $student->kelas]) }}" class="btn btn-sm btn-success"><i class="bi bi-pencil-square"></i></a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4 d-flex justify-content-center">
                            {{ $students ? $students->links() : '' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
