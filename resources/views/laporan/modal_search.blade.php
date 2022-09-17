<div class="modal fade" id="modal-search" tabindex="-1" aria-labelledby="modal-search-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-search-label">Generate Laporan Siswa Berprestasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_serach" action="{{ route('manage.laporan') }}" method="get">

                    <div class="form-group">
                        <label for="jenis">Jenis Filter</label>
                        <select class="form-select" name="jenis" id="jenis" required>
                            <option>Pilih Jenis</option>
                            <option value="tahun_ajaran">Per Tahun Ajaran</option>
                            <option value="kelas">Per Kelas</option>
                        </select>
                    </div>

                    <div id="id-tahun_ajaran" class="form-group d-none">
                        <label for="tahun_ajaran">Tahun Ajaran</label>
                        <select class="form-select" name="tahun_ajaran" id="tahun_ajaran" required>
                            <option value="1">2021/2022</option>
                            <option value="2">2022/2023</option>
                        </select>
                    </div>

                    <div id="id-kelas"  class="form-group d-none">
                        <label for="kelas">Kelas</label>
                        <select class="form-select" name="kelas" id="kelas">
                            <option value="1">Kelas 7</option>
                            <option value="2">Kelas 8</option>
                            <option value="3">Kelas 9</option>
                        </select>
                    </div>
					
					<div id="id-rank"  class="form-group d-none">
                        <label for="kelas">Ranking</label>
                        <select class="form-select" name="rank" id="rank">
                            <option value="0">Semua Ranking</option>
                            <option value="10">10</option>
                            <option value="9">9</option>
                            <option value="8">8</option>
                            <option value="7">7</option>
                            <option value="6">6</option>
                            <option value="5">5</option>
                            <option value="4">4</option>
                            <option value="3">3</option>
                            <option value="2">2</option>
                            <option value="1">1</option>
                        </select>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" onclick="form_search_submit()" class="btn btn-primary">Cari</button>
            </div>
        </div>
    </div>
</div>

@push('javascript')
    <script>
         $("#jenis").change(function () {
            var value = this.value;

            $('#id-tahun_ajaran').addClass('d-none');
            $('#id-kelas').addClass('d-none');

            if (value === 'tahun_ajaran') {
                $('#id-tahun_ajaran').removeClass('d-none');
                $('#id-rank').removeClass('d-none');
            } else if (value === 'kelas') {
                $('#id-tahun_ajaran').removeClass('d-none');
                $('#id-kelas').removeClass('d-none');
                $('#id-rank').removeClass('d-none');
            }

        });
    </script>

    <script>
        function form_search_submit()
        {
            $('#form_serach').submit();
        }
    </script>
@endpush
