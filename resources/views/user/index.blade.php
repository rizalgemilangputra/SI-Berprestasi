@extends('layouts.app')

@section('title', 'Data Pengguna')

@section('content')
    <section class="section">
        <div class="row" id="table-striped">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('manage.user.create') }}" class="btn btn-success">
                                    Tambah Pengguna
                                </a>
                            </div>
                            <div class="col-md-6">
                                <form action="{{ url('user/') }}" method="GET">
                                    <div class="row d-flex flex-row-reverse">
                                        <div class="col-6">
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" placeholder="Cari Nama Pengguna"
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
                                        <th>Email</th>
                                        <th>Nama</th>
                                        <th>Hak Akses</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td class="text-bold-500">{{ $user->email }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->hak_akses }}</td>
                                            <td>
                                                <a href="{{ route('manage.siswa.edit', ['no_induk' => $user->id]) }}" class="btn btn-sm btn-success"><i class="bi bi-pencil-square"></i></a>
                                                <a href="{{ route('manage.siswa.delete', ['no_induk' => $user->id]) }}" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4 d-flex justify-content-center">
                            {{ $users ? $users->links() : '' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
