@extends('layouts.app')

@section('title', 'Ubah Data Siswa')

@section('content')
    <form id="form-edit-data-siswa" method="POST" action="{{route('manage.siswa.update')}}">
        <div class="card p-4">
            @csrf
            @method('POST')

            <input type="hidden" name="id" value="{{ $student->id }}">

            <div class="form-group">
                <label for="no_induk">No. Induk</label>
                <input type="text" class="form-control @error('no_induk') is-invalid @enderror" id="no_induk" name="no_induk" value="{{old('no_induk', $student->no_induk)}}" placeholder="No. Induk" disabled>
                @error('no_induk')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Nama" value="{{old('nama', $student->nama)}}">
                @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div><button type="submit" class="btn btn-success">Simpan</button></div>
        </div>
    </form>
    @foreach ($student->detail as $detail)
        <div id="detail-tahun-ajaran">
            <div class="card p-4">
                <form id="form-edit-data-siswa" method="POST" action="{{ route('manage.siswa.update.tahun_ajaran', ['no_induk' => $student->no_induk, 'id' => $detail->id]) }}">
                    @csrf
                    @method('POST')
                    <div class="row" id="detail">
                        <div class="form-group">
                            <label for="tahun_ajaran">Tahun Ajaran</label>
                            <select class="form-select" name="tahun_ajaran" id="tahun_ajaran" required>
                                <option value="1" {{$detail->tahun_ajaran == 1 ? 'selected' : ''}}>2021/2022</option>
                                <option value="2" {{$detail->tahun_ajaran == 2 ? 'selected' : ''}}>2022/2023</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <select class="form-select" name="kelas" id="kelas" required>
                                <option value="1" {{$detail->kelas == 1 ? 'selected' : ''}}>Kelas 7</option>
                                <option value="2" {{$detail->kelas == 2 ? 'selected' : ''}}>Kelas 8</option>
                                <option value="2" {{$detail->kelas == 3 ? 'selected' : ''}}>Kelas 9</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="is_active">Aktif</label>
                            <select class="form-select" name="is_active" id="is_active" required>
                                <option value="0" {{$detail->is_active == 0 ? 'selected' : ''}}>Tidak Aktif</option>
                                <option value="1" {{$detail->is_active == 1 ? 'selected' : ''}}>Aktif</option>
                            </select>
                        </div>
                    </div>

                    <div><button type="submit" class="btn btn-success">Simpan</button></div>
                </form>
            </div>
        </div>
    @endforeach

    <div class="d-flex justify-content-center">
        <button id="tambah-tahun-ajaran" type="button" class="btn btn-primary me-4">Tambah Tahun Ajaran</button>
    </div>
@endsection

@push('javascript')
    <script type="text/javascript">
        $("#tambah-tahun-ajaran").click(function () {
            var html = '';
            html += '<div class="card p-4">';
                html += '<form id="form-edit-data-siswa" method="POST" action="{{ route("manage.siswa.update.tahun_ajaran", ["no_induk" => $student->no_induk]) }}">';
                    html += '@csrf';
                    html += '@method("POST")';
                    html += '<div class="row" id="detail">';

                        html += '<div class="form-group">';
                            html += '<label for="tahun_ajaran">Tahun Ajaran</label>';
                            html += '<select class="form-select" name="tahun_ajaran" id="tahun_ajaran" required>';
                                html += '<option value="1">2021/2022</option>';
                                html += '<option value="2">2022/2023</option>';
                            html += '</select>';
                        html += '</div>';

                        html += '<div class="form-group">';
                            html += '<label for="kelas">Kelas</label>';
                            html += '<select class="form-select" name="kelas" id="kelas" required>';
                                html += '<option value="1">Kelas 7</option>';
                                html += '<option value="2">Kelas 8</option>';
                            html += '</select>';
                        html += '</div>';

                        html += '<div class="form-group">';
                            html += '<label for="is_active">Aktif</label>';
                            html += '<select class="form-select" name="is_active" id="is_active" required>';
                                html += '<option value="0">Tidak Aktif</option>';
                                html += '<option value="1" selected>Aktif</option>';
                            html += '</select>';
                        html += '</div>';
                    html += '</div>';

                    html += '<div><button type="submit" class="btn btn-success">Simpan</button></div>';
                html += '</form>';
            html += '</div>';
            $("#detail-tahun-ajaran").append(html);
        });
    </script>
@endpush
