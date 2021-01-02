<?php
// query mengambil data bantuan

$this->db->select('judul_bantuan,url_judulbantuan');

$this->db->join('bantuan', 'bantuan.id_bantuan = judul_bantuan.id_bantuan');
$menu = $this->db->get_where('judul_bantuan', array('judul_bantuan.id_bantuan' => 2))->result_array();


?>
<!-- Navbar -->
<nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url('bantuan/info') ?>"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i> </a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" style="margin-left: 20px;">
                </a>
            </li>
        </ul>
    </div>
</nav>
<br>

<!-- content -->
<div class="container-fluid mt-5">
    <div class="container" style="width: 90%; background-color:white">
        <!-- cari bantuan -->
        <form action="bantuan">
            <div class="input-group mb-3">
                <button class="btn btn-outline-secondary" type="button" id="button-addon1"><i class="fa fa-search"></i></button>
                <input type="text" class="form-control" name="keyword" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
            </div>
        </form>

        <!-- jenis-jenis bantuan -->
        <?php foreach ($menu as $m) : ?>
            <hr class="dropdown-divider">
            <a class="dropdown-item" href="<?= $m['url_judulbantuan']; ?>"> <?= $m['judul_bantuan']; ?></a>

            <hr class="dropdown-divider">
        <?php endforeach; ?>
    </div>
</div>