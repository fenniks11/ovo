<?= $total_bayar["total"] ?>

<nav class="navbar navbar-light bg-light">
    <?= $this->session->flashdata('pesan'); ?>
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url('user') ?>"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i> </a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" style="margin-left: 20px;">
                    <h2>Pulsa & Paket Data</h2>
                </a>
            </li>
        </ul>
    </div>
</nav>
<div class="container-fluid" style="background-color: white;">
    <br>
    <br>
    <form action="<?= base_url('merchant/pulsa') ?>" method="post">
        <input type="hidden" name="id_pengguna" value="<?= $user["id_pengguna"] ?>">
        <input type="hidden" name="no_referensi" value="<?= $nomor_referensi; ?>">
        <input type="hidden" name="id_jenis_transaksi" value="<?= $jenis_transaksi[0]["id_jenis_transaksi"] ?>">
        <input type="hidden" name="total" value="<?= $total_bayar["total"] ?>">
        <input type="hidden" name="waktu_transaksi" value="<?= $total_tagihan['waktu_transaksi'] ?>">
        <div class="mb-3 mx-5">
            <label for="exampleFormControlTextarea1" class="form-label text-muted">Nomor Ponsel</label>
            <input class="form-control form-control-lg" type="text" value="<?= $user['nomor_ponsel']; ?>" aria-label=".form-control-lg example" style="height: 100px; font-size:40px">
        </div>
        <br>
        <br>
        <br>
        <div class="container">
            <ul class="nav nav-tabs  nav-justified" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Isi Pulsa</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Paket Data</a>
                </li>
            </ul>
        </div>
</div>
<br>
<div class="container">
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="container">
                <?= form_error('nominal', '<small class="text-danger text-center pl-3">', '</small>'); ?>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="btn-group-vertical ">
                            <input type="radio" name="nominal" value="5000" class="btn-check form-control" id="btncheck1" autocomplete="off" style="width: 100%;">
                            <label class="btn btn-outline-primary mb-4" for="btncheck1" style="width: 525px;">5000</label>

                            <input type="radio" name="nominal" value="10000" class="btn-check form-control" id="btncheck2" autocomplete="off" style="width: 100%;">
                            <label class="btn btn-outline-primary mb-4" for="btncheck2" style="width: 525px;">10000</label>

                            <input type="radio" name="nominal" value="20000" class="btn-check form-control" id="btncheck3" autocomplete="off" style="width: 100%;">
                            <label class="btn btn-outline-primary mb-4" for="btncheck3" style="width: 525px;">20000</label>

                            <input type="radio" name="nominal" value="25000" class="btn-check form-control" id="btncheck4" autocomplete="off" style="width: 100%;">
                            <label class="btn btn-outline-primary mb-4" for="btncheck4" style="width: 525px;">25000</label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="btn-group-vertical ">
                            <input type="radio" name="nominal" value="50000" class="btn-check form-control" id="btncheck5" autocomplete="off" style="width: 100%;">
                            <label class="btn btn-outline-primary mb-4" for="btncheck5" style="width: 525px;">50000</label>

                            <input type="radio" name="nominal" value="100000" class="btn-check form-control" id="btncheck6" autocomplete="off" style="width: 100%;">
                            <label class="btn btn-outline-primary mb-4" for="btncheck6" style="width: 525px;">100000</label>

                            <input type="radio" name="nominal" value="150000" class="btn-check form-control" id="btncheck7" autocomplete="off" style="width: 100%;">
                            <label class="btn btn-outline-primary mb-4" for="btncheck7" style="width: 525px;">150000</label>

                            <input type="radio" name="nominal" value="200000" class="btn-check form-control" id="btncheck8" autocomplete="off" style="width: 100%;">
                            <label class="btn btn-outline-primary mb-4" for="btncheck8" style="width: 525px;">200000</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%;">OK</button>
                </form>
                <br>
                <br>
            </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="card w-75 mx-auto">
                <div class="card-body">
                    <div class="row">
                        <div class="col-7">
                            <a href="#" class="nav-link text-secondary">
                                <h5 class="card-title">Extra Edukasi 5GB/3Hari</h5>
                            </a>
                        </div>
                        <div class="col-5">
                            <a href="#" class="nav-link text-info text-end">Lihat Detail</a>
                        </div>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    </div>
                </div>
            </div>
            <br>

            <div class="card w-75 mx-auto">
                <div class="card-body">
                    <div class="row">
                        <div class="col-7">
                            <a href="#" class="nav-link text-secondary">
                                <h5 class="card-title">Extra Edukasi 5GB/3Hari</h5>
                            </a>
                        </div>
                        <div class="col-5">
                            <a href="#" class="nav-link text-info text-end">Lihat Detail</a>
                        </div>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    </div>
                </div>
            </div>
            <br>

            <div class="card w-75 mx-auto">
                <div class="card-body">
                    <div class="row">
                        <div class="col-7">
                            <a href="#" class="nav-link text-secondary">
                                <h5 class="card-title">Extra Edukasi 5GB/3Hari</h5>
                            </a>
                        </div>
                        <div class="col-5">
                            <a href="#" class="nav-link text-info text-end">Lihat Detail</a>
                        </div>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    </div>
                </div>
            </div>
            <br>

            <div class="card w-75 mx-auto">
                <div class="card-body">
                    <div class="row">
                        <div class="col-7">
                            <a href="#" class="nav-link text-secondary">
                                <h5 class="card-title">Extra Edukasi 5GB/3Hari</h5>
                            </a>
                        </div>
                        <div class="col-5">
                            <a href="#" class="nav-link text-info text-end">Lihat Detail</a>
                        </div>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    </div>
                </div>
            </div>
            <br>

            <div class="card w-75 mx-auto">
                <div class="card-body">
                    <div class="row">
                        <div class="col-7">
                            <a href="#" class="nav-link text-secondary">
                                <h5 class="card-title">Extra Edukasi 5GB/3Hari</h5>
                            </a>
                        </div>
                        <div class="col-5">
                            <a href="#" class="nav-link text-info text-end">Lihat Detail</a>
                        </div>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    </div>
                </div>
            </div>
            <br>

            <div class="card w-75 mx-auto">
                <div class="card-body">
                    <div class="row">
                        <div class="col-7">
                            <a href="#" class="nav-link text-secondary">
                                <h5 class="card-title">Extra Edukasi 5GB/3Hari</h5>
                            </a>
                        </div>
                        <div class="col-5">
                            <a href="#" class="nav-link text-info text-end">Lihat Detail</a>
                        </div>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    </div>
                </div>
            </div>
            <br>

            <div class="card w-75 mx-auto">
                <div class="card-body">
                    <div class="row">
                        <div class="col-7">
                            <a href="#" class="nav-link text-secondary">
                                <h5 class="card-title">Extra Edukasi 5GB/3Hari</h5>
                            </a>
                        </div>
                        <div class="col-5">
                            <a href="#" class="nav-link text-info text-end">Lihat Detail</a>
                        </div>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    </div>
                </div>
            </div>
            <br>

            <div class="card w-75 mx-auto">
                <div class="card-body">
                    <div class="row">
                        <div class="col-7">
                            <a href="#" class="nav-link text-secondary">
                                <h5 class="card-title">Extra Edukasi 5GB/3Hari</h5>
                            </a>
                        </div>
                        <div class="col-5">
                            <a href="#" class="nav-link text-info text-end">Lihat Detail</a>
                        </div>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    </div>
                </div>
            </div>
            <br>

            <div class="card w-75 mx-auto">
                <div class="card-body">
                    <div class="row">
                        <div class="col-7">
                            <a href="#" class="nav-link text-secondary">
                                <h5 class="card-title">Extra Edukasi 5GB/3Hari</h5>
                            </a>
                        </div>
                        <div class="col-5">
                            <a href="#" class="nav-link text-info text-end">Lihat Detail</a>
                        </div>
                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    </div>
                </div>
            </div>
            <br>
        </div>
    </div>
</div>