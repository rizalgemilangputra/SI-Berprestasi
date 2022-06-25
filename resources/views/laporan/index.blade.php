@extends('layouts.app')

@section('title', 'Laporan Siswa Berprestasi')

@section('content')
    <div class="card">
        <div class="card-header">
            <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target="#modal-search">Cari</button>
            @if (Request::has('jenis') && Request::get('jenis') == 'tahun_ajaran')
                <div><span class="fw-bold">Tahun Aajaran :</span> {{ App\Models\TahunAjaran::$tahun_ajaran[Request::get('tahun_ajaran')] }} </div>
            @elseif (Request::has('jenis') && Request::get('jenis') == 'kelas')
                <div><span class="fw-bold">Tahun Aajaran :</span> {{ App\Models\TahunAjaran::$tahun_ajaran[Request::get('tahun_ajaran')] }} </div>
                <div><span class="fw-bold">Kelas :</span> {{ App\Models\Kelas::$kelas[Request::get('kelas')] }} </div>
            @endif
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>Rank</th>
                            <th>No. Induk</th>
                            <th>Nama</th>
                            @if (Request::has('jenis') && Request::get('jenis') == 'tahun_ajaran')
                                <th>Kelas</th>
                            @endif
                            <th>Nilai Preferensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $report)
                            <tr>
                                <td>{{ $report->rank }}</td>
                                <td>{{ $report->no_induk }}</td>
                                <td>{{ $report->nama }}</td>
                                @if (Request::has('jenis') && Request::get('jenis') == 'tahun_ajaran')
                                    <th>{{ App\Models\Kelas::$kelas[$report->kelas] }}</th>
                                @endif
                                <td>{{ $report->nilai_preferensi }}</td>
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

    @include('laporan.modal_search')
@endsection
