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
    </div>

    @foreach ($student->detail as $detail)
        <div class="card p-4">
            <div class="row" id="detail">
                <div class="form-group">
                    <label for="tahun_ajaran-{{$detail->id}}">Tahun Ajaran</label>
                    <select class="form-select @error('tahun_ajaran-{{$detail->id}}') is-invalid @enderror" name="tahun_ajaran-{{$detail->id}}" id="tahun_ajaran-{{$detail->id}}" required>
                        <option selected value="1" {{old("tahun_ajaran-{$detail->id}") == 1 ? 'selected' : ''}}>2021/2022</option>
                        <option selected value="2" {{old("tahun_ajaran-{$detail->id}") == 2 ? 'selected' : ''}}>2022/2023</option>
                    </select>
                    @error('tahun_ajaran-{{$detail->id}}')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="kelas-{{$detail->id}}">Kelas</label>
                    <select class="form-select @error('kelas-{{$detail->id}}') is-invalid @enderror" name="kelas-{{$detail->id}}" id="kelas-{{$detail->id}}" required>
                        <option value="1" {{old("kelas-{$detail->id}") == 1 ? 'selected' : ''}}>Kelas 7</option>
                        <option value="2" {{old("kelas-{$detail->id}") == 2 ? 'selected' : ''}}>Kelas 8</option>
                    </select>
                    @error('kelas-{{$detail->id}}')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
    @endforeach

</form>
@endsection
