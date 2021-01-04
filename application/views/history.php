<?php

$id_user = $this->session->userdata('nohp');

$queryHistory = "SELECT distinct history.waktu_transaksi, nota.nominal, jenis_transaksi.nama_transaksi, nota.status_transaksi, history.id_pengguna 
                FROM history join jenis_transaksi on jenis_transaksi.id_jenis_transaksi = history.id_jenis_transaksi 
                join nota on nota.no_referensi = history.no_referensi 
                join profil on profil.id_pengguna = history.id_pengguna
                where profil.nomor_ponsel = $id_user";
$menu = $this->db->query($queryHistory)->result_array();

?>

<nav class="navbar" style="background-color: #683699;">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url('user') ?>"><i class="fa fa-arrow-left fa-2x text-white" aria-hidden=" true"></i> </a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" style="margin-left: 20px;">
                    <h3 class="text-white">OVO - History</h3>
                </a>
            </li>
        </ul>
    </div>
</nav>
<br>

<div class="container-fluid">
    <div class="container">
        <div class="card">
            <?php foreach ($menu as $m) : ?>
                <div class="card-header">
                    <?= $m['waktu_transaksi']; ?>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"><?= $m['nama_transaksi']; ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row"><?= $m['nama_transaksi']; ?> sebesar <?= $m['nominal']; ?> sudah <?= $m['status_transaksi']; ?></th>
                            </tr>

                        </tbody>
                    </table>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>