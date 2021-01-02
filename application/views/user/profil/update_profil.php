<nav class="navbar nav-justified sticky-top" style="background-color: #683699;">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url('user/profil') ?>"><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i>
        </a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <span class="navbar-brand h1 text-white">Edit Profil</span>
            </li>
        </ul>
    </div>
</nav>
<div class="container-fluid" style="background: white;"><br><br><br>
    <div class="row">
        <div class="col-lg">
            <?= $this->session->flashdata('pesan'); ?>
        </div>
    </div>
    <!-- Ubah Profil -->
    <div class="container">
        <form action="<?= base_url('user/update_profil') ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-2">
                    <img src="<?= base_url('assets/img/profil/') . $user['img']; ?>" alt="" style="border-radius: 50%; width:100%">
                </div>
                <div class="col-10 mt-5">
                    <h2 class="text-info">Perbarui Foto Profil</h2>
                    <div class="mb-3">
                        <input class="form-control" type="file" id="img" name="img">
                    </div>
                </div>
            </div><br><br>
            <legend>
                <h5 class="text-muted">
                    Nama Lengkap
                </h5>
            </legend>
            <input class="form-control form-control-lg" type="text" placeholder="Default input" aria-label="default input example" name="nama" value="<?= $user['nama_lengkap']; ?>">
            <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
            <br>
            <hr class="dropdown-divider"><br><br>
            <legend>
                <h5 class="text-muted">
                    Nomor Ponsel
                </h5>
            </legend>
            <input class="form-control form-control-lg" type="text" placeholder="Default input" aria-label="default input example" name="nohp" value="<?= $user['nomor_ponsel']; ?>">
            <?= form_error('nohp', '<small class="text-danger pl-3">', '</small>'); ?>
            <br><br>
            <legend>
                <h5 class="text-muted">
                    Email
                </h5>
            </legend>
            <input class="form-control form-control-lg" type="text" placeholder="Default input" aria-label="default input example" name="email" value="<?= $user['email']; ?>">
            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
            <br><br>
            <button class="btn btn-info text-white" type="submit" style="width: 100%;">
                Ubah Profil
            </button>
        </form>
    </div>
    <br>
    <br>
    <br>
</div>