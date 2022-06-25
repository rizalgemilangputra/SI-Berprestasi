@extends('layouts.app')

@section('title', 'Generate Laporan Siswa Berprestai')

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal-generate">Generate Laporan</button>
                </div>
                <div class="col-md-6">
                    <form id="form_serach" action="{{ route('manage.generate_laporan') }}" method="get">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <select class="form-select" name="jenis" id="jenis" required>
                                        <option>Pilih Jenis</option>
                                        <option value="tahun_ajaran" {{ Request::get('jenis') == 'tahun_ajaran' ? 'selected' : '' }}>Per Tahun Ajaran</option>
                                        <option value="kelas" {{ Request::get('jenis') == 'kelas' ? 'selected' : '' }}>Per Kelas</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div id="id-tahun_ajaran" class="form-group">
                                    <select class="form-select" name="tahun_ajaran" id="tahun_ajaran" required>
                                        <option>Pilih Tahun Ajaran</option>
                                        <option value="1" {{ Request::get('tahun_ajaran') == '1' ? 'selected' : '' }}>2021/2022</option>
                                        <option value="2" {{ Request::get('tahun_ajaran') == '2' ? 'selected' : '' }}>2022/2023</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tahun Ajaran</th>
                            <th>Kelas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $report)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ App\models\TahunAJaran::$tahun_ajaran[$report->tahun_ajaran] }}</td>
                                <td>{{ Request::get('jenis') == 'kelas' ? App\models\Kelas::$kelas[$report->detail[0]->kelas] : '' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4 d-flex justify-content-center">
                {{ $reports ? $reports->links() : '' }}
            </div>
        </div>
    </div>
    @include('generate_laporan.modal_generate')
@endsection
