<nav class="navbar nav-justified sticky-top" style="background-color: #683699;">
    <div class="container-fluid">
        <?= $this->session->flashdata('pesan'); ?>
        <span class="navbar-brand mb-0 h1 text-white">OVO</span>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="<?= base_url('notif') ?>"><i class="fa fa-bell text-white"></i></a></li>
        </ul>
    </div>
</nav>
<div class="container-fluid" style="background-color: white;">
    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="mb-3">
                    <input type="email" class="form-control" id="exampleFormControlInput1" style="height: 100px;" placeholder="cari merchant..">
                </div>
            </div>
            <div class="col-lg-3">
                <button type="submit" class="btn btn-outline-secondary"><i class="fa fa-search fa-5x"></i></button>
            </div>
        </div>
    </div>
    <br>
    <br>
</div>
<br>
<div class="container-fluid" style="background-color: white;">
    <?php

    $queryCashback = "SELECT * FROM cashback limit 5 ";
    $menu = $this->db->query($queryCashback)->result_array();

    ?>
    <br><br>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="text-start">Cashback Lagi dan Lagi </h1>
            </div>
            <div class="col ">
                <a href="<?= base_url('deals/semua_cashback') ?>" class="nav-link  text-info">
                    <h3 class="text-sm-end">Lihat semuanya</h3>
                </a>
            </div>
            <h4 class="text-muted">Serbu Berbagai promo terbaru OVO</h4>
        </div>
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <ol class="carousel-indicators">
                <?php
                $i = 0;
                foreach ($menu as $m) {
                    if ($i == 0) {
                ?>
                        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $i; ?>" class="active"></li>
                        <?php
                        $i++;
                    } else {
                        if ($i != 0) {

                        ?>
                            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $i; ?>"></li>
                <?php
                        }
                        $i++;
                    }
                }
                ?>
            </ol>
            <div class="carousel-inner">
                <?php
                $i = 0;
                foreach ($menu as $m) {
                    if ($i == 0) {
                ?>
                        <div class="carousel-item active">
                            <a href="<?= base_url($m['url']) ?>"><img src="<?= base_url('assets/img/cashback/') . $m['gambar_cashback']; ?>" class="d-block w-100" alt="..." style="height: 450px;"></a>
                        </div>
                        <?php
                        $i++;
                    } else {
                        if ($i != 0) {
                        ?>
                            <div class="carousel-item">

                                <a href="<?= base_url($m['url']) ?>"><img src="<?= base_url('assets/img/cashback/') . $m['gambar_cashback']; ?>" class="d-block w-100" alt="..." style="height: 450px;"></a>
                            </div>
                <?php
                        }
                        $i++;
                    }
                }
                ?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
    </div>
    <br><br>
</div>
<br>
<div class="container-fluid mb-4" style="background-color: white;">
    <?php

    $queryVoucher = "SELECT * FROM voucher limit 5";
    $menu = $this->db->query($queryVoucher)->result_array();

    ?>
    <br><br>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="text-start">Kolom Kebahagiaan</h1>
            </div>
            <div class="col ">
                <a href="<?= base_url('deals/semua_voucher') ?>" class="nav-link  text-info">
                    <h3 class="text-sm-end">Lihat semuanya</h3>
                </a>
            </div>
        </div>

        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <ol class="carousel-indicators">
                <?php
                $i = 0;
                foreach ($menu as $m) {
                    if ($i == 0) {
                ?>
                        <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $i; ?>" class="active"></li>
                        <?php
                        $i++;
                    } else {
                        if ($i != 0) {

                        ?>
                            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $i; ?>"></li>
                <?php
                        }
                        $i++;
                    }
                }
                ?>
            </ol>
            <div class="carousel-inner">
                <?php
                $i = 0;
                foreach ($menu as $m) {
                    if ($i == 0) {
                ?>
                        <div class="carousel-item active">
                            <a href="<?= base_url($m['url']) ?>"><img src="<?= base_url('assets/img/voucher/') . $m['gambar_voucher']; ?>" class="d-block w-100" alt="..." style="height: 450px;"></a>
                        </div>
                        <?php
                        $i++;
                    } else {
                        if ($i != 0) {
                        ?>
                            <div class="carousel-item">

                                <a href="<?= base_url($m['url']) ?>"><img src="<?= base_url('assets/img/voucher/') . $m['gambar_voucher']; ?>" class="d-block w-100" alt="..." style="height: 450px;"></a>
                            </div>
                <?php
                        }
                        $i++;
                    }
                }
                ?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
    </div>
    <br>
    <br>
</div>