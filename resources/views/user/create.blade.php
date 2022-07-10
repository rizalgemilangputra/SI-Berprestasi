@extends('layouts.app')

@section('title', 'Tambah Data Siswa')

@section('content')
    <div class="card">
        <form id="form-input-data-siswa" method="POST" action="{{route('manage.user.store')}}" class="p-4">
            @csrf
            @method('POST')
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{old('email')}}" placeholder="Email">
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Password">
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nama" value="{{old('name')}}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="hak_akses">Hak Akses</label>
                <select class="form-select @error('hak_akses') is-invalid @enderror" name="hak_akses" id="hak_akses" required>
                    <option value="kesiswaan" {{old('hak_akses') == 'kesiswaan' ? 'selected' : ''}}>Kesiswaan</option>
                    <option value="walikelas" {{old('hak_akses') == 'walikelas' ? 'selected' : ''}}>Walikelas / Pembina</option>
                    <option value="kepalasekolah" {{old('hak_akses') == 'kepalasekolahs' ? 'selected' : ''}}>Kepala Sekolah</option>
                </select>
                @error('hak_akses')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
@endsection
