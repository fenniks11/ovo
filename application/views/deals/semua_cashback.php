<?php

$queryCashback = "SELECT gambar_cashback, url FROM cashback ";
$menu = $this->db->query($queryCashback)->result_array();
?>

<!-- Navbar -->
<nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url('deals') ?>"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i> </a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" style="margin-left: 20px;">
                </a>
            </li>
        </ul>
    </div>
</nav>
<br>

<div class="container mx-auto" style="width: 90%;">
    <?php foreach ($menu as $m) : ?>
        <a href="<?= base_url($m['url']) ?>"><img src="<?= base_url('assets/img/cashback/') . $m['gambar_cashback']; ?>" class="d-block w-100  rounded" alt="..." style="height: 450px;"></a>
        <br>
    <?php endforeach; ?>
</div>