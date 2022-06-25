@extends('layouts.app')

@section('title', 'Data Siswa')

@section('content')
    <section class="section">
        <div class="row" id="table-striped">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('manage.siswa.create') }}" class="btn btn-success">
                                    Tambah Siswa
                                </a>
                            </div>
                            <div class="col-md-6">
                                <form action="{{ url('siswa/') }}" method="GET">
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
                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="card-content px-4 pb-4">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No. Induk</th>
                                        <th>Nama</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-bold-500">{{ $student->no_induk }}</td>
                                            <td>{{ $student->nama }}</td>
                                            <td>
                                                <a href="{{ route('manage.siswa.detail', ['no_induk' => $student->no_induk]) }}" class="btn btn-sm btn-primary"><i class="bi bi-eye-fill"></i></a>
                                                <a href="{{ route('manage.siswa.edit', ['no_induk' => $student->no_induk]) }}" class="btn btn-sm btn-success"><i class="bi bi-pencil-square"></i></a>
                                                <a href="{{ route('manage.siswa.delete', ['no_induk' => $student->no_induk]) }}" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>
                                            </td>
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
