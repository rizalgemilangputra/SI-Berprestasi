@extends('layouts.app')

@section('title', 'Detail Nilai Siswa')

@section('content')
    <div class="card">
        <form id="form-input-data-siswa" method="POST" action="{{route('manage.detail_nilai.update', ['no_induk' => $student->no_induk, 'tahun_ajaran' => $student->tahun_ajaran, 'kelas' => $student->kelas])}}" class="p-4">
            @csrf
            @method('POST')

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="no_induk">No. Induk</label>
                    <input type="text" class="form-control" id="no_induk" name="no_induk" value="{{ $student->no_induk }}" placeholder="No. Induk" disabled>
                </div>

                <div class="form-group col-md-6">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="{{ $student->nama }}" disabled>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label for="no_induk">Tahun Ajaran</label>
                    <input type="text" class="form-control" id="no_induk" name="no_induk" value="{{ App\Models\TahunAjaran::$tahun_ajaran[$student->tahun_ajaran] }}" disabled>
                </div>

                <div class="form-group col-md-6">
                    <label for="nama">Kelas</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="{{ App\Models\Kelas::$kelas[$student->kelas] }}" disabled>
                </div>
            </div>

            <hr class="my-4">

            <div class="form-group">
                <label for="nilai_rerata">Nilai Rerata</label>
                <input type="text" class="form-control @error('nilai_rerata') is-invalid @enderror" id="nilai_rerata" name="nilai_rerata" placeholder="Nilai Rerata" value="{{old('nilai_rerata', $student->nilai_rerata)}}">
                @error('nilai_rerata')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="nilai_absensi">Nilai Absensi</label>
                <input type="text" class="form-control @error('nilai_absensi') is-invalid @enderror" id="nilai_absensi" name="nilai_absensi" placeholder="Nilai Absensi" value="{{old('nilai_absensi', $student->nilai_absensi)}}">
                @error('nilai_absensi')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="nilai_sikap">Nilai Sikap</label>
                <select class="form-select @error('nilai_sikap') is-invalid @enderror" name="nilai_sikap" id="nilai_sikap" required>
                    <option selected value="A" {{old('nilai_sikap', $student->nilai_sikap) == 'A' ? 'selected' : ''}}>A</option>
                    <option selected value="B" {{old('nilai_sikap', $student->nilai_sikap) == 'B' ? 'selected' : ''}}>B</option>
                    <option selected value="C" {{old('nilai_sikap', $student->nilai_sikap) == 'C' ? 'selected' : ''}}>C</option>
                    <option selected value="D" {{old('nilai_sikap', $student->nilai_sikap) == 'D' ? 'selected' : ''}}>D</option>
                    <option selected value="E" {{old('nilai_sikap', $student->nilai_sikap) == 'E' ? 'selected' : ''}}>E</option>
                </select>
                @error('nilai_sikap')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="nilai_ekstrakulikuler">Nilai Ekstrakulikuler</label>
                <select class="form-select @error('nilai_ekstrakulikuler') is-invalid @enderror" name="nilai_ekstrakulikuler" id="nilai_ekstrakulikuler" required>
                    <option selected value="A" {{old('nilai_ekstrakulikuler', $student->nilai_ekstrakulikuler) == 'A' ? 'selected' : ''}}>A</option>
                    <option selected value="B" {{old('nilai_ekstrakulikuler', $student->nilai_ekstrakulikuler) == 'B' ? 'selected' : ''}}>B</option>
                    <option selected value="C" {{old('nilai_ekstrakulikuler', $student->nilai_ekstrakulikuler) == 'C' ? 'selected' : ''}}>C</option>
                    <option selected value="D" {{old('nilai_ekstrakulikuler', $student->nilai_ekstrakulikuler) == 'D' ? 'selected' : ''}}>D</option>
                    <option selected value="E" {{old('nilai_ekstrakulikuler', $student->nilai_ekstrakulikuler) == 'E' ? 'selected' : ''}}>E</option>
                </select>
                @error('nilai_ekstrakulikuler')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
@endsection
