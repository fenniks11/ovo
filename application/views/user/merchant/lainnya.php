<?php
// query mengambil isi dari table merchant
$queryMerchant = "SELECT * FROM merchant";
$menu = $this->db->query($queryMerchant)->result_array();
?>

<!-- Navbar -->
<nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url('user') ?>"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i> </a>
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
<div class="container-fluid">
    <form action="bantuan">
        <div class="input-group mb-3">
            <button class="btn btn-outline-secondary" type="button" id="button-addon1"><i class="fa fa-search"></i></button>
            <input type="text" class="form-control" name="keyword" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
        </div>
    </form>
    <div class="container" style="width: 80%; background-color:white">
        <!-- cari bantuan -->

        <!-- jenis-jenis bantuan -->
        <?php foreach ($menu as $m) : ?>
            <div class="row">
                <div class="col-1">
                    <img src="<?= $m['gambar_merchant']; ?>" alt="">
                </div>
                <div class="col-11">
                    <a class="dropdown-item" href="<?= base_url($m['url']) ?>">
                        <h3>&nbsp;<?= $m['nama_merchant']; ?></h3>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>