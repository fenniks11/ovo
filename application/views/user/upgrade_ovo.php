print_r(<?= $user['jenis_ovo'] ?>)
<!-- CSS -->
<style>
    #my_camera {
        width: 320px;
        height: 240px;
        border: 1px solid black;
    }
</style>
<div class="container-fluid">
    <div class="container mt-4">
        <h1 class="text-center text-primary">Upgrade ke OVO Premier</h1>
        <br>
        <div class="mb-3 row">
            <?php
            if (isset($error_upload)) {
                echo '<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' . $error_upload . '</div>';
            }
            echo validation_errors('<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>', '</div>');

            echo form_open_multipart('upgrade_ovo'); ?>

            <input type="hidden" name="id_pengguna" value="<?= $user['id_pengguna']; ?>">
            <label for="inputPassword" class="col-sm-2 col-form-label">
                <h5>Nomor NIK</h5>
            </label>
            <div class="col-lg">
                <input type="text" class="form-control" name="NIK">
            </div>
            <?= form_error('NIK', '<small class="text-danger pl-3">', '</small>'); ?>
            <br>
            <label for="inputPassword" class="col-sm-2 col-form-label">
                <h5>Foto KTP</h5>
            </label>
            <div class="col-lg">
                <input class="form-control" type="file" id="formFile" name="foto_ktp">
            </div>
            <br>
            <br>
            <button type="submit" class="btn btn-primary" style="width: 100%;">Upgrade</button>
            <?php echo form_close(); ?>
        </div>
    </div>