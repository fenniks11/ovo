<div class="container mx-auto" style=" width:85%;">
    <div class="row">
        <!-- button Top UP, Transfer, dan history -->
        <div class="card-group" style="margin-top: -50px; width:100%; height:100px;">
            <div class="col-4">
                <div class="card text-center border-light">
                    <a href="<?= base_url('user/topup') ?>" class="nav-link">
                        <img src="https://img.icons8.com/material-sharp/96/000000/topup-payment.png" / class="card-img-center" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Top up</h5>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-4">
                <div class="card text-center border-light">

                    <?php if ($this->session->userdata('jenis_ovo') === '1') ?>
                    <a href="<?= base_url('transfer') ?>" class="nav-link tombol-transfer">
                        <img src="https://img.icons8.com/dusk/96/000000/money-transfer.png" / class="card-img-center" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Transfer</h5>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-4">
                <div class="card text-center border-light">
                    <a href="#" class="nav-link">
                        <img src="https://img.icons8.com/color/96/000000/activity-history.png" / class="card-img-center" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">History</h5>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Button Nav -->