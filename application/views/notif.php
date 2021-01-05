<nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url('user') ?>"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i> </a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" style="margin-left: 20px;">
                    <h3>Notifikasi</h3>
                </a>
            </li>
        </ul>
    </div>
</nav>

<?php

$id_user = $this->session->userdata('nohp');

$queryNotif = "SELECT transfer.waktu, transfer.nominal, transfer.nomor_ponsel_penerima, notifikasi.isi_pesan, notifikasi.id_notifikasi, notifikasi.isi_notifikasi
                FROM notifikasi join transfer on transfer.id_transfer = notifikasi.id_transfer  
                join profil on profil.id_pengguna = notifikasi.id_pengguna
                where profil.nomor_ponsel = $id_user";
$menu = $this->db->query($queryNotif)->result_array();

?>
<div class="container mt-5" style="width: 80%; box-shadow:black">
    <?php foreach ($menu as $m) : ?>
        <div class="row">
            <div class="col-sm-1">
                <a href="<?= base_url('notif/delete/') . $m['id_notifikasi'] ?>" onclick="return confirm('Apakah data ingin dihapus?')" class="btn btn-outline-danger" style="margin-bottom:20px">
                    <i class="fa fa-trash"></i></a>
            </div>
            <div class="col-lg-11">
                <div class="card">
                    <h5 class="card-header"><?= $m['waktu']; ?></h5>
                    <div class="card-body">
                        <h5 class="card-title"><?= $m['isi_notifikasi']; ?></h5>
                        <p class="card-text"><?= $m['isi_notifikasi']; ?> ke <?= $m['nomor_ponsel_penerima']; ?> sebesar <?= $m['nominal']; ?> telah berhasil</p>
                        <p><?= $m['isi_pesan']; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <br>
    <?php endforeach; ?>
</div>