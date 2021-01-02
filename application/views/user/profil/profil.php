<?php
$data['user'] = $this->db->get('profil')->result();
?>


<!-- Navbar -->
<nav class="navbar nav-justified navbar-dark bg-light sticky-top">
    <div class="container-fluid">
        <span class="navbar-brand mb-0 h1">OVO</span>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><i class="fa fa-bell fa-3x"></i></a></li>
        </ul>
    </div>
</nav>

<!-- end navbar -->


<!-- content -->
<div class="container-fluid" style="background-color: white;">
    <br>
    <div class="container">
        <h1>Profil</h1>
        <br>
        <div class="row">
            <div class="col-md-1">
                <img src="<?= base_url('assets/img/profil/') . $user['img']; ?>" alt="">
            </div>
            <div class="col-md">
                <h3><?= $user['nama_lengkap']; ?></h3>
                <small class="text-muted"><?= $user['nomor_ponsel']; ?></small>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-1">
                <i class="fa fa-circle-o-notch fa-3x" aria-hidden="true"></i>
            </div>
            <div class="col-sm-9">
                <h1>OVO -&nbsp;<?= $user['nama_ovo']; ?> </h1>
            </div>
            <div class="col-sm-2">
                <a href="">
                    <h4>Lihat detail</h4>
                </a>
            </div>
        </div>


    </div>
</div>
<br>
<div class="container-fluid" style="background-color: white;">
    <br>
    <div class="container">
        <h1>OVO ID</h1>
        <br>
        <div class="row">
            <div class="col-6">
                <div class="card mx-auto text-center" style="width: 70%;">
                    <div class="card-body">
                        <!-- Button trigger modal QR code -->
                        <a data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fa fa-qrcode fa-3x">&nbsp;QR Code</i>
                        </a>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog  modal-sm">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="row">
                                    <h1 class="modal-title" id="exampleModalLabel">QR CODE</h1>
                                    <small class="text-muted">Tunjukkan ini untuk transfer sesama OVO</small>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <img src="<?php echo site_url('user/qrcode/' . $user['nomor_ponsel']); ?>" alt="" style="width: 100%; height:250px;">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Barcode button -->
            <div class="col-6">
                <div class="card mx-auto text-center" style="width: 70%;">
                    <div class="card-body">
                        <a data-bs-toggle="modal" data-bs-target="#exampleModalbarcode">
                            <i class="fa fa-barcode fa-3x">&nbsp;Loyalty</i>
                        </a>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModalbarcode" tabindex="-1" aria-labelledby="exampleModalbarcodeLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="row">
                                    <h1 class="modal-title" id="exampleModalLabel">Loyalty Code</h1>
                                    <small class="text-muted">Tunjukkan barcode untuk di-scan oleh kasir</small>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <img src="<?php echo site_url('user/Barcode/' . $user['nomor_ponsel']); ?>" alt="" style="width: 100%; height:150px;">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
    </div>
</div>
<br>
<div class="container-fluid" style="background-color: white;">

    <br>
    <div class="container">
        <h1> <strong>Akun</strong> </h1>
        <br>
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <div class="row">
                        <div class="col-1">
                            <img src="https://img.icons8.com/dusk/64/000000/change-user-male.png" />
                        </div>
                        <div class="col-11">
                            <a class="nav-link" href="<?= base_url('user/update_profil'); ?>">
                                Ubah Profil
                            </a>
                        </div>
                    </div>
                </h2>
            </div>
            <br>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        MyCards
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="card mx-auto bg-primary mb-3" style="width: 60%; height:300px">
                            <div class="card-body">
                                <div class="card-title">
                                    <h1>OVO</h1>
                                </div>
                                <br>
                                <br>
                                <h1 class="text-white"><?= $user['nomor_ponsel']; ?></h1>
                                <div class="card-title">
                                    <h1>
                                        <?= $user['nama_lengkap']; ?>
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Kode Promo
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Masukkan Kode Promo</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Kode Promo">
                            <br>
                            <button type="button" href="" class="btn btn-success" style="width:100%">Klaim Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
</div>

<br>
<div class="container-fluid" style="background-color: white;">
    <br>
    <div class="container">
        <h1>Keamanan</h1>
        <br>
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <a class="nav-link" href="#" style="--bs-breadcrumb-divider: '>';">
                        <i class="fa fa-lock fa-3x"></i>&nbsp;Ubah Kode Keamanan
                    </a>
                </h2>
            </div>
        </div>
    </div>
</div>
<br>
<div class="container-fluid" style="background-color: white;">
    <br>
    <div class="container">
        <h1>Tentang</h1>
        <br>
        <a href="<?= base_url('privasi') ?>" class="dropdown-item" style="width: 100%;">
            <i class="fa fa-thropy fa-2x" aria-hidden="true"></i>&nbsp;Keuntungan Pakai OVO
        </a>
        <hr class="dropdown-divider">
        <br>
        <a href="<?= base_url('privasi') ?>" class="dropdown-item" style="width: 100%;">
            <i class="fa fa-lightbulb-o fa-2x" aria-hidden="true"></i>&nbsp;Panduan OVO
        </a>
        <hr class="dropdown-divider">
        <br>
        <a href="<?= base_url('privasi') ?>" class="dropdown-item" style="width: 100%;">
            <i class="fa fa-file-text fa-2x" aria-hidden="true"></i>&nbsp;Syarat dan Ketentuan
        </a>
        <hr class="dropdown-divider">
        <br>
        <a href="<?= base_url('privasi') ?>" class="dropdown-item" style="width: 100%;">
            <i class="fa fa-shield fa-2x" aria-hidden="true"></i>&nbsp;Kebijakan Privasi
        </a>
        <hr class="dropdown-divider">
        <br>
        <a href="<?= base_url('bantuan') ?>" class="dropdown-item" style="width: 100%;">
            <i class="fa fa-question-circle fa-2x" aria-hidden="true"></i>&nbsp;Pusat Bantuan
        </a>
        <hr class="dropdown-divider">
        <br><br><br>
    </div>
</div>
</div>
<div style="margin-top: 40px ;"></div>

<!-- end content -->
<!-- button sign out -->
<a href="<?= base_url('auth/logout') ?>" class="btn btn-primary" style="width:100%;">Sign Out</a>

<div style="margin-bottom: 40px;"></div>
<!-- end content -->