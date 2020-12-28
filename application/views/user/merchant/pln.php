<nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url('user') ?>"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i> </a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" style="margin-left: 20px;">
                    <h3>PLN</h3>
                </a>
            </li>
        </ul>
    </div>
</nav>
<br>

<div class="container-fluid">
    <div class="container">

        <div class="nav nav-tabs nav-justified" id="nav-tab" role="tablist">

            <a class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"> Token Listrik</a>
            <a class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Tagihan Listrik</a>
        </div>

        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <form action="<?= base_url('merchant') ?>" method="POST">
                    <input type="hidden" name="id_pengguna" value="<?= $user["id_pengguna"] ?>">
                    <input type="hidden" name="total" value="<?= $listrik["total"] ?>">
                    <input type="hidden" name="biaya">
                    <div class="container mt-4" style="background-color: white;">
                        <small class="text-muted">Nomor Meter</small>
                        <div class="input-group flex-nowrap">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="nomor_meter" placeholder="Contoh: 1234567890" aria-describedby="basic-addon3">
                            </div>
                        </div>
                        <?= form_error('nomor_meter', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <br>
                    <div class="container">
                        <?= form_error('nominal', '<small class="text-danger text-center pl-3">', '</small>'); ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="btn-group-vertical ">
                                    <input type="radio" name="nominal" value="20000" class="btn-check form-control" id="btncheck1" autocomplete="off" style="width: 100%;">
                                    <label class="btn btn-outline-primary mb-4" for="btncheck1" style="width: 525px;">20000</label>

                                    <input type="radio" name="nominal" value="100000" class="btn-check form-control" id="btncheck2" autocomplete="off" style="width: 100%;">
                                    <label class="btn btn-outline-primary mb-4" for="btncheck2" style="width: 525px;">100000</label>

                                    <input type="radio" name="nominal" value="500000" class="btn-check form-control" id="btncheck3" autocomplete="off" style="width: 100%;">
                                    <label class="btn btn-outline-primary mb-4" for="btncheck3" style="width: 525px;">500000</label>

                                    <input type="radio" name="nominal" value="5000000" class="btn-check form-control" id="btncheck4" autocomplete="off" style="width: 100%;">
                                    <label class="btn btn-outline-primary mb-4" for="btncheck4" style="width: 525px;">5000000</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="btn-group-vertical ">
                                    <input type="radio" name="nominal" value="50000" class="btn-check form-control" id="btncheck5" autocomplete="off" style="width: 100%;">
                                    <label class="btn btn-outline-primary mb-4" for="btncheck5" style="width: 525px;">50000</label>

                                    <input type="radio" name="nominal" value="200000" class="btn-check form-control" id="btncheck6" autocomplete="off" style="width: 100%;">
                                    <label class="btn btn-outline-primary mb-4" for="btncheck6" style="width: 525px;">200000</label>

                                    <input type="radio" name="nominal" value="1000000" class="btn-check form-control" id="btncheck7" autocomplete="off" style="width: 100%;">
                                    <label class="btn btn-outline-primary mb-4" for="btncheck7" style="width: 525px;">1000000</label>

                                    <input type="radio" name="nominal" value="10000000" class="btn-check form-control" id="btncheck8" autocomplete="off" style="width: 100%;">
                                    <label class="btn btn-outline-primary mb-4" for="btncheck8" style="width: 525px;">10000000</label>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary" style="width: 100%;">OK</button>
                    </div>
                </form>
            </div>

            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <form action="<?= base_url('merchant') ?>" method="POST">
                    <input type="hidden" name="id_pengguna" value="<?= $user["id_pengguna"] ?>">
                    <input type="hidden" name="id_pengguna" value="PLN">
                    <div class="container mt-4" style="background-color: white;">
                        <small class="text-muted">ID Pelanggan</small>
                        <div class="input-group flex-nowrap">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="ID" placeholder="Contoh: 1234567890" aria-describedby="basic-addon3">
                            </div>
                        </div>
                    </div>
                    <br>

                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="btn-group-vertical ">
                                    <input type="radio" name="nominal" value="20000" class="btn-check form-control" id="btncheck9" autocomplete="off" style="width: 100%;">
                                    <label class="btn btn-outline-success mb-4" for="btncheck9" style="width: 525px;">20000</label>

                                    <input type="radio" name="nominal" value="100000" class="btn-check form-control" id="btncheck10" autocomplete="off" style="width: 100%;">
                                    <label class="btn btn-outline-success mb-4" for="btncheck10" style="width: 525px;">100000</label>

                                    <input type="radio" name="nominal" value="500000" class="btn-check form-control" id="btncheck11" autocomplete="off" style="width: 100%;">
                                    <label class="btn btn-outline-success mb-4" for="btncheck11" style="width: 525px;">500000</label>

                                    <input type="radio" name="nominal" value="5000000" class="btn-check form-control" id="btncheck12" autocomplete="off" style="width: 100%;">
                                    <label class="btn btn-outline-success mb-4" for="btncheck12" style="width: 525px;">5000000</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="btn-group-vertical ">
                                    <input type="radio" name="nominal" value="50000" class="btn-check form-control" id="btncheck13" autocomplete="off" style="width: 100%;">
                                    <label class="btn btn-outline-success mb-4" for="btncheck13" style="width: 525px;">50000</label>

                                    <input type="radio" name="nominal" value="200000" class="btn-check form-control" id="btncheck14" autocomplete="off" style="width: 100%;">
                                    <label class="btn btn-outline-success mb-4" for="btncheck14" style="width: 525px;">200000</label>

                                    <input type="radio" name="nominal" value="1000000" class="btn-check form-control" id="btncheck15" autocomplete="off" style="width: 100%;">
                                    <label class="btn btn-outline-success mb-4" for="btncheck15" style="width: 525px;">1000000</label>

                                    <input type="radio" name="nominal" value="10000000" class="btn-check form-control" id="btncheck16" autocomplete="off" style="width: 100%;">
                                    <label class="btn btn-outline-success mb-4" for="btncheck16" style="width: 525px;">10000000</label>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success" style="width: 100%;">OK</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>