<!-- Navbar -->
<nav class="navbar sticky-top" style="background-color: #683699;">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url('deals/semua_voucher') ?>"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i> </a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" style="margin-left: 20px;">
                </a>
            </li>
        </ul>
    </div>
</nav>
<img src="<?= base_url('assets/img/voucher/') . $voucher['gambar_voucher']; ?>" class="img-fluid" style="width:100%; height:250px;">
<div class="container-fluid mb-4" style="background-color: white;">
    <?= $this->session->flashdata('pesan'); ?>
    <div class="container mx-auto" style="width: 90%;">
        <div class="d-flex p-2 bd-highlight" style="margin-top: -120px;">
            <div class="card text-dark bg-light mb-3 mx-auto" style="width: 900px; height:200px">
                <div class="card-body">
                    <h5 class="card-title"><strong><?= $voucher['nama_voucher']; ?></strong></h5>
                    <br>
                    <h5 class="card-text text-muted">Tersedia <?= $voucher['banyak_voucher']; ?></h5>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <p class="card-text text-muted"> <b>Berlaku sampai</b>
                                <p>
                        </div>
                        <div class="col">
                            <p class="card-text text-muted text-end"><b><?= $voucher['tgl_akhir']; ?></b>
                                <p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h1 class="card-title">Detail</h1>
        <h5 class="card-text" style="text-wrap: break-word; text-align:justify"><?= $voucher['deskripsi']; ?></h5>
    </div>
    <br><br><br>
</div>
<div class="container-fluid" style="background-color: white;">
    <div class="container">
        <h1 class="card-title">Syarat & Ketentuan</h1>
        <h5 class="card-text" style="text-wrap: break-word"><?= $voucher['syarat_ketentuan']; ?></h5>
    </div>
</div>
<footer class="footer mt-auto py-3 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h3 class="text-muted">
                    Harga Voucher
                </h3>
                <h2>Rp.<?= number_format($voucher['harga'], 0, ',', '.') ?>,-</h2>
            </div>
            <div class="col-lg-6">
                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-info text-white" style="float: right;width:75%; margin-top:20px">Beli Sekarang</button>
            </div>
        </div>
    </div>
</footer>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= $voucher['nama_voucher']; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <br>
            </div>
            <div class="modal-body">
                <h5 class="modal-title" id="exampleModalLabel">
                    Jumlah Saldo Anda Adalah Senilai Rp.<?php echo number_format($user['jumlah_saldo'], 0, ',', '.') ?>,-</h5>
                <br>
                <form action="<?= base_url('deals/voucher_makan') ?>" method="post">
                    <h3>Total Nilai Pesanan</h3>
                    Rp.<?= number_format($voucher['harga'], 0, ',', '.') ?>,-
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-info text-white" style="float: right;">
                    Bayar
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>