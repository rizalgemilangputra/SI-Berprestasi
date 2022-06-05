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
                        <!-- table striped -->
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
                                    <tr>
                                        <td class="text-bold-500">10114024</td>
                                        <td>Rizal Gemilang Putra</td>
                                        <td>20</td>
                                        <td>A</td>
                                        <td>B</td>
                                        <td>C</td>
                                        <td>
                                            <a href="#">
                                                <i class="badge-circle badge-circle-light-secondary font-medium-1"
                                                    data-feather="mail">1</i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-bold-500">10114000</td>
                                        <td>Revina Nurjanah</td>
                                        <td>20</td>
                                        <td>A</td>
                                        <td>B</td>
                                        <td>C</td>
                                        <td>
                                            <a href="#">
                                                <i class="badge-circle badge-circle-light-secondary font-medium-1"
                                                    data-feather="mail">1</i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('siswa.modal-input')
@endsection
