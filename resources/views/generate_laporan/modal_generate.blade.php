<div class="modal fade" id="modal-generate" tabindex="-1" aria-labelledby="modal-generate-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-generate-label">Generate Laporan Siswa Berprestasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form_generate" action="{{ route('manage.generate_laporan.generate') }}" method="post">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="tahun_ajaran">Tahun Ajaran</label>
                        <select class="form-select" name="tahun_ajaran" id="tahun_ajaran" required>
                            <option selected value="1">2021/2022</option>
                            <option selected value="2">2022/2023</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" onclick="form_generate_submit()" class="btn btn-success">Generate</button>
            </div>
        </div>
    </div>
</div>

@push('javascript')
    <script>
        function form_generate_submit()
        {
            $('#form_generate').submit();
        }
    </script>
@endpush
