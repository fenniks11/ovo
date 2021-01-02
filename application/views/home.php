<div class="container" style="margin-top: 200px;">
    <div class="row">

        <?php

        $queryMerchant = "SELECT * FROM merchant";
        $menu = $this->db->query($queryMerchant)->result_array();
        ?>

        <?php foreach ($menu as $m) : ?>
            <div class="col-3">
                <div class="card text-center border-light">
                    <a href="<?= base_url($m['url']) ?>" class="nav-link">
                        <img src="<?= $m['gambar_merchant']; ?>" class="card-img-center" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $m['nama_merchant']; ?></h5>
                        </div>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<hr style="height:2em;">
</div>
<div class="container-fluid">
    <?php

    $queryPromo = "SELECT * FROM promo ";
    $menu = $this->db->query($queryPromo)->result_array();

    ?>
    <div class="row">
        <div class="col">
            <h3 class="text-start">Info dan Promo special</h3>
        </div>
        <div class="col ">
            <a href="#" class="nav-link  text-info">
                <h5 class="text-sm-end">Lihat semuanya</h5>
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
                        <a href="<?= base_url('promo') ?>"><img src="<?= base_url('assets/img/promo/') . $m['gambar_promo']; ?>" class="d-block w-100" alt="..."></a>
                    </div>
                    <?php
                    $i++;
                } else {
                    if ($i != 0) {
                    ?>
                        <div class="carousel-item">

                            <a href="<?= base_url('promo') ?>"><img src="<?= base_url('assets/img/promo/') . $m['gambar_promo']; ?>" class="d-block w-100" alt="..."></a>
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

<hr style="height: 2em;">
<div class="container">
    <h1><b>Yang menarik di OVO</b> </h1>
    <small>Jangan ngaku update kalau belum cobaa fitur ini</small>
    <div class="card" style="width: 18rem;">
        <a href="#" class="nav-link">
            <img src="https://img.icons8.com/clouds/100/000000/help.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <small class="text-info"> Go somewhere</small>
        </a>
    </div>
</div>
</div>