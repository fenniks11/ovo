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
    <h3>Info dan Promo special</h3>
    <a href="#" style="float: right;">Lihat semuanya</a>
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"></li>
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4"></li>
        </ol>
        <div class="carousel-inner">
            <?php foreach ($menu as $m) : ?>
                <div class="carousel-item active">
                    <img src="<?= base_url('assets/img/promo/') . $m['gambar_promo']; ?>" class="d-block w-100" alt="...">
                    <a href="user/promo"></a>
                </div>
            <?php endforeach; ?>
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