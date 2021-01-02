<?php
// query mengambil data bantuan

$this->db->select('nama_subjudulbantuan,deskripsi_bantuan');

$this->db->join('judul_bantuan', 'judul_bantuan.id_judul_bantuan = sub_judul_bantuan.id_judul_bantuan');
$menu = $this->db->get_where('sub_judul_bantuan')->result_array();

?>

<!-- Navbar -->
<nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url('bantuan/') ?>"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i> </a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" style="margin-left: 20px;">
                </a>
            </li>
        </ul>
    </div>
</nav>
<br>

<div class="container-fluid mt-5">
    <div class="container">
        <form action="bantuan">
            <div class="input-group mb-3">
                <button class="btn btn-outline-secondary" type="button" id="button-addon1"><i class="fa fa-search"></i></button>
                <input type="text" class="form-control" name="keyword" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
            </div>
        </form>
        <div class="container-sm">
            <?php foreach ($menu as $m) : ?>
                <ul class="nav-link">
                    <li class="nav-link"> <a href=""><?= $m['nama_subjudulbantuan']; ?></a> </li>
                    <ul class="nav-link">
                        <li class="nav-link"><?= $m['deskripsi_bantuan']; ?></li>
                    </ul>
                </ul>
            <?php endforeach; ?>

        </div>
    </div>
</div>