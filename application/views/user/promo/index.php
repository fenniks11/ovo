<?php

$queryPromo = "SELECT * FROM promo ";
$menu = $this->db->query($queryPromo)->result_array();

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

<div class="container mx-auto">
    <?php foreach ($menu as $m) : ?>
        <a href="<?= base_url('promo') ?>"><img src="<?= base_url('assets/img/promo/') . $m['gambar_promo']; ?>" class="d-block w-100  rounded" alt="..."></a>
        <br>
    <?php endforeach; ?>
</div>