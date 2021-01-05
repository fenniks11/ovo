<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Anda menggunakan OVO Reguler, silakan update ke OVO Premier.</h5>
            </div>
            <div class="modal-body">
                <p class="card-text text-center">Apakah anda yakin untuk update ke OVO Premier? Kami membutuhkan informasi penting seperti NIK, KTP, dan identitas anda lainnya. </p>
                <div class="row">
                    <div class="col-lg-6">
                        <a href="<?= base_url('upgrade_ovo') ?>" class="btn btn-primary" style="width: 100%;">Ya, saya yakin</a>
                    </div>
                    <div class="col-lg-6">
                        <a href="<?= base_url('user') ?>" class="btn btn-secondary" style="width: 100%;">Batal</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#myModal").modal('show');
    });
</script>