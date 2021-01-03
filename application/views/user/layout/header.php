<nav class="navbar nav-justified sticky-top" style="background-color: #683699;">
    <div class="container-fluid">
        <?= $this->session->flashdata('pesan'); ?>
        <span class="navbar-brand mb-0 h1 text-white">OVO</span>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><i class="fa fa-bell text-white"></i></a></li>
        </ul>
    </div>
</nav>

<img src="<?= base_url('assets/img/header.png') ?>" class="img-fluid" style="width:100%; height:250px;">

<div class="row">
    <div class="top-left" style="position: absolute;top: 60px; left: 2px;">
        <h4 class="text-white">OVO cash</h4>
        <h4 class="text-white">Rp.</h4>
        <h1 class="text-white" style="padding-left:40px;"><?php echo number_format($user['jumlah_saldo'], 0, ',', '.') ?></h1>
        <h4 class="text-white">OVO Points 0</h4>
    </div>