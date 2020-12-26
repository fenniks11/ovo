<nav class="navbar" style="background-color: #683699;">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url('user') ?>"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i> </a>
    </div>
</nav>
<img src="<?= base_url('assets/img/header.png') ?>" class="img-fluid" style="width:100%; height:250px;">
<ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="instant-tab" data-bs-toggle="tab" href="#instant" role="tab" aria-controls="instant" aria-selected="false">
            <h3>Instant</h3>
        </a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link" id="metodelain-tab" data-bs-toggle="tab" href="#metodelain" role="tab" aria-controls="metodelain" aria-selected="false">
            <h3>Metode lain</h3>
        </a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade" id="instant" role="tabpanel" aria-labelledby="instant-tab">
        <h1>Top Up ke</h1>
        <div class="card mb-80" style="width:100%">
            <div class="row g-0">
                <div class="col-md-4">
                    <img class="rounded" src="<?= base_url() ?>assets/img/logo.jpg" alt="...">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h1 class="card-text">OVO Cash</h1>
                        <p class="card-text"><small class="text-muted">Balance Rp.<?= $user['jumlah_saldo']; ?></small></p>
                    </div>
                </div>
            </div>
        </div>
        <hr style="height:2em;">
        <div class="container">
            <form action="<?= base_url('user/topup'); ?>" method="POST">
                <h1>Pilih Nominal Top Up</h1>
                <div class="d-grid gap-2 d-md-block mx-auto">
                    <button class="btn btn-outline-secondary" type="button" name="nominal_top_up" value="200000">Rp.200.000;</button>
                    <button class="btn btn-outline-secondary" type="button" name="nominal_top_up" value="500000">Rp.500.000;</button>
                    <button class="btn btn-outline-secondary" type="button" name="nominal_top_up" value="100000">Rp.100.000;</button>
                </div>
                <br>
                <small class="text-muted">Atau masukkan nominal top up di sini!</small>
                <div class="input-group mb-3 input-group-lg">
                    <span class="input-group-text">Rp.</span>
                    <input type="hidden" name="id_pengguna" value="<?= $user["id_pengguna"] ?>">
                    <input type="text" class="form-control" name="nominal_top_up" value="<?= set_value('nominal_top_up') ?>">
                </div>
                <?= form_error('nominal_top_up', '<small class="text-danger pl-3">', '</small>'); ?>
                <br>
                <button type="submit" class="btn btn-primary" style="width: 25%;">OK</button>
        </div>
        </form>
    </div>
    <br>
    <br>
    <div class="tab-pane fade" id="metodelain" role="tabpanel" aria-labelledby="metodelain-tab">
        <br>
        <div class="container">
            <small class="text-muted">Top Up Saldo Ke</small>
            <input class="form-control form-control-lg" type="text" placeholder="OVO Cash" aria-label=".form-control-lg example">
            <br>
            <br>

            <div class="card w-100" style="background-color: whitesmoke;">
                <div class="card-body">
                    <h2 class="card-title text-center">Saldo OVO Cash</h2>
                    <p class="card-text text-center">Rp. <?= $user['jumlah_saldo']; ?></p>
                </div>
            </div>
            <small class="text-center">Maksimal saldo OVO cash adalah Rp.10.000.000</small>
        </div>
    </div>
    <br>
</div>