@extends('layouts.app')

@section('title', 'Tambah Data Siswa')

@section('content')
    <div class="card">
        <form id="form-input-data-siswa" method="POST" action="{{route('manage.siswa.store')}}" class="p-4">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="no_induk">No. Induk</label>
                <input type="text" class="form-control @error('no_induk') is-invalid @enderror" id="no_induk" name="no_induk" value="{{old('no_induk')}}" placeholder="No. Induk">
                @error('no_induk')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Nama" value="{{old('nama')}}">
                @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="tahun_ajaran">Tahun Ajaran</label>
                <select class="form-select @error('tahun_ajaran') is-invalid @enderror" name="tahun_ajaran" id="tahun_ajaran" required>
                    <option selected value="1" {{old('tahun_ajaran') == 1 ? 'selected' : ''}}>2021/2022</option>
                    <option selected value="2" {{old('tahun_ajaran') == 2 ? 'selected' : ''}}>2022/2023</option>
                </select>
                @error('tahun_ajaran')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="kelas">Kelas</label>
                <select class="form-select @error('kelas') is-invalid @enderror" name="kelas" id="kelas" required>
                    <option value="1" {{old('kelas') == 1 ? 'selected' : ''}}>Kelas 7</option>
                    <option value="2" {{old('kelas') == 2 ? 'selected' : ''}}>Kelas 8</option>
                    <option value="2" {{old('kelas') == 3 ? 'selected' : ''}}>Kelas 9</option>
                </select>
                @error('kelas')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
@endsection
