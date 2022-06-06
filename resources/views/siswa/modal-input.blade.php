<div class="modal fade" id="modal-input" tabindex="-1" aria-labelledby="modal-input-label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-input-label">Input Data Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form-input-data-siswa" method="POST" action="{{url('siswa/')}}" class="p-4">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="no_induk">No. Induk</label>
                        <input type="number" class="form-control" id="no_induk" name="no_induk" placeholder="No. Induk" required>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" required>
                    </div>

                    <div class="form-group">
                        <label for="rerata_nilai">Rerata Nilai</label>
                        <input type="number" class="form-control" id="rerata_nilai" name="rerata_nilai" placeholder="Rerata Nilai"
                            required>
                    </div>

                    <div class="form-group">
                        <label for="nilai_absensi">Nilai Absensi</label>
                        <input type="number" class="form-control" id="nilai_absensi" name="nilai_absensi" placeholder="Nilai Absen" required>
                    </div>

                    <div class="form-group">
                        <label for="nilai_sikap">Nilai Sikap</label>
                        <input type="number" class="form-control" id="nilai_sikap" name="nilai_sikap" placeholder="Nilai Sikap" required>
                    </div>

                    <div class="form-group">
                        <label for="nilai_ekstrakulikuler">Nilai Ekstrakulikuler</label>
                        <input type="number" class="form-control" id="nilai_ekstrakulikuler" name="nilai_ekstrakulikuler" placeholder="Nilai Extrakulikuler" required>
                    </div>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

@section('javascript')
    <script>
        $('#form-input-data-siswa').submit(function (e) {
            e.preventDefault();

            swal({
                title: "Menyimpan Data ...",
                text: "Mohon tunggu",
                buttons: false,
                closeOnClickOutside: false,
                closeOnEsc: false
            });

            var url = e.target.action
            var formData = $(this).serialize()
            $.post(url, formData, function (response) {
                if(response.status){
                    $('#form-input-data-siswa').trigger("reset");
                    swal({
                        title: "Berhasil",
                        text: response.message,
                        icon: "success",
                        closeOnClickOutside: false,
                        closeOnEsc: false,
                        timer: 5000,
                    });
                }else{
                    swal({
                        title: "Gagal",
                        text: response.message,
                        icon: "error",
                        closeOnClickOutside: false,
                        closeOnEsc: false,
                        timer: 5000,
                    });
                }
            });
        });
    </script>
@endsection
