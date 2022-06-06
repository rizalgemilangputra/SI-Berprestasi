@extends('layouts.app')

@section('title')
    Data Siswa
@endsection

@section('content')
    <section class="section">
        <div class="row" id="table-striped">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-input">
                            Tambah Siswa
                        </button>
                    </div>
                    <div class="card-content px-4 pb-4">


                        <form action="{{ url('siswa/') }}" method="GET">
                            <div class="row d-flex flex-row-reverse">
                                <div class="col-4">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Cari No. Induk Siswa"
                                            aria-label="Cari No. Induk Siswa" aria-describedby="basic-addon2" name="cari" value="{{ Request::get('cari') }}">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary">Cari</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>No. Induk</th>
                                        <th>Nama</th>
                                        <th>Rerata Nilai</th>
                                        <th>Absensi</th>
                                        <th>Sikap</th>
                                        <th>Nilai Extra</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td class="text-bold-500">{{ $student->no_induk }}</td>
                                            <td>{{ $student->nama }}</td>
                                            <td>{{ $student->rerata_nilai }}</td>
                                            <td>{{ $student->nilai_absensi }}</td>
                                            <td>{{ $student->nilai_sikap }}</td>
                                            <td>{{ $student->nilai_ekstrakulikuler }}</td>
                                            <td>
                                                <a href="#">
                                                    <i class="badge-circle badge-circle-light-secondary font-medium-1"
                                                        data-feather="mail">1</i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4 d-flex justify-content-center">
                            {{ $students->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('siswa.modal-input')
@endsection
