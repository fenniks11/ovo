<div class="container-fluid">
    <?= $this->session->flashdata('pesan'); ?>
    <div class="container mt-4">
        <form action="<?= base_url('user/sesama_ovo'); ?>" method="post">
            <div class="mb-3 row" style="margin-top: 100px;">
                <div class="col-11">
                    <textarea class="form-control" name="nomor_ponsel_penerima" placeholder="Masukkan Nomor Ponsel" rows="3"></textarea>
                </div>
                <div class="col-1">
                    <i class="fa fa-address-book-o fa-5x" aria-hidden="true" style="width: 100%;"></i>
                </div>
                <?= form_error('nomor_ponsel_penerima', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>

            <div class="card mb-3 mx-auto">
                <div class="col">
                    <img src="" alt="">
                </div>
                <div class="col-11">
                    <h3 class="card-title" style="margin-left: 40px;">OVO CASH</h3>
                    <p class="text-muted">Saldo</p>
                    <p class="card-text">Rp. <?php echo number_format($user['jumlah_saldo'], 0, ',', '.') ?></p>
                </div>
            </div>
            <br>

            <div class="input-group mb-3 input-group-lg" style="height: 100px;">
                <span class="input-group-text">Rp.</span>
                <input type="hidden" name="id_pengguna" value="<?= $user["id_pengguna"] ?>">
                <input type="text" class="form-control" name="nominal" value="<?= set_value('nominal_top_up') ?>">
            </div>
            <?= form_error('nominal', '<small class="text-danger pl-3">', '</small>'); ?>
            <br>
            <button type="submit" class="btn btn-primary" style="width: 25%;">Transfer</button>
        </form>
    </div>
    <br>
</div>