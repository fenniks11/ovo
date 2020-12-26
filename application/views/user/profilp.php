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
                    <h1><?= $user['jenis_ovo']; ?> </h1>
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
                            <i class="fa fa-qrcode fa-3x">&nbsp;QR Code</i>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card mx-auto text-center" style="width: 70%;">
                        <div class="card-body">
                            <i class="fa fa-barcode fa-3x">&nbsp;Loyalty</i>
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
            <h1>Akun</h1>
            <br>
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <a class="nav-link" href="#" style="--bs-breadcrumb-divider: '>';">
                            Ubah Profil
                        </a>
                    </h2>
                </div>
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
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <i class="fa fa-thropy fa-2x" aria-hidden="true"></i>&nbsp;Keuntungan Pakai OVO
                        </button>
                    </h2>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <i class="fa fa-lightbulb-o fa-2x" aria-hidden="true"></i>&nbsp;Panduan OVO
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

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <i class="fa fa-file-text fa-2x" aria-hidden="true"></i>&nbsp;Syarat dan Ketentuan
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
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <i class="fa fa-shield fa-2x" aria-hidden="true"></i>&nbsp;Kebijakan Privasi
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
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <i class="fa fa-question-circle fa-2x" aria-hidden="true"></i>&nbsp;Pusat Bantuan
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
    </div>