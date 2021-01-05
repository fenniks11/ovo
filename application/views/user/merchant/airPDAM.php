<nav class="navbar nav-justified sticky-top" style="background-color: #683699;">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url('user') ?>"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i> </a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" style="margin-left: 20px;">
                    <h3>Air PDAM</h3>
                </a>
            </li>
        </ul>
    </div>
</nav>
<img src="<?= base_url('assets/img/header.png') ?>" class="img-fluid" style="width:100%; height:250px;">
<div class="container-fluid mb-5" style="background-color: white;">
    <div class="container" style="width: 80%;">
        <br><br>
        <label for="floatingSelectGrid">Lokasi</label>
        <select class="form-select" name="lokasi" aria-label="Default select example">
            <option selected>Open this select menu</option>
            <option value="1">Jawa Timur-Probolinggo</option>
            <option value="2">Jawa Tengah - Kab Pekalongan</option>
            <option value="3">Sulawesi - Kab Polewali Mandar</option>
            <option value="4">Jawa Timur- Kab Situbondo</option>
            <option value="5">DKI Jakarta - PALYKJA</option>
            <option value="6">Jawa Tengah</option>

        </select>
        <br><br>
        <label for="floatingTextarea2">Nomor Pelanggan</label>
        <div class="form-floating">
            <textarea class="form-control" name="nomor_pelanggan" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
        </div>
        <div class="container mt-5">
            <!-- Button trigger modal -->
            <button type="button" style="float: right; width:100%" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Bayar
            </button>
            <br><br>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Masukkan Jumlah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url('merchant/airPDAM') ?>" method="post">
                    <div class="modal-body">
                        <input type="hidden" name="id_pengguna" value="<?= $user["id_pengguna"] ?>">
                        <input type="hidden" name="no_referensi" value="<?= $nomor_referensi; ?>">
                        <input type="hidden" name="waktu_transaksi" value="<?= $total_tagihan['waktu_transaksi'] ?>">
                        <input type="text" class="form-control-lg" name="nominal">
                    </div>
                    <?= form_error('nomor_meter', '<small class="text-danger pl-3">', '</small>'); ?>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Lanjutkan Pembayaran</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>