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
            <form action="<?= base_url('user/upgrade_ovo') ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_pengguna" value="<?= $user['id_pengguna']; ?>">
                <input type="hidden" name="jenis_ovo">

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
                    <input type="file" class="form-control" name="foto_ktp">
                </div>
                <br>
                <label for="inputPassword" class="col-sm-2 col-form-label">
                    <h5>Foto Selfi KTP</h5>
                </label>
                <div class="col-lg">
                    <div id="my_camera"></div>
                    <br>
                    <br>
                    <input type="button" class="btn btn-outline-secondary mr-2" value="Configure" onClick="configure()">
                    <input type=button class="btn btn-outline-primary" value="Take Snapshot" onClick="take_snapshot()">
                    <input type=button class="btn btn-outline-warning" value="Save Snapshot" onClick="saveSnap()">
                    <div id="results"></div>
                </div>
                <br>
                <br>
                <button type="submit" class="btn btn-primary" style="width: 100%;">Upgrade</button>
            </form>
        </div>
    </div>


    <!-- Script -->
    <script type="text/javascript" src="<?= base_url() ?>assets/js/webcam.min.js"></script>

    <!-- Code to handle taking the snapshot and displaying it locally -->
    <script language="JavaScript">
        // Configure a few settings and attach camera
        function configure() {
            Webcam.set({
                width: 320,
                height: 240,
                image_format: 'jpeg',
                jpeg_quality: 90
            });
            Webcam.attach('#my_camera');
        }
        // A button for taking snaps


        // preload shutter audio clip
        var shutter = new Audio();
        shutter.autoplay = false;
        shutter.src = navigator.userAgent.match(/Firefox/) ? 'shutter.ogg' : 'shutter.mp3';

        function take_snapshot() {
            // play sound effect
            shutter.play();

            // take snapshot and get image data
            Webcam.snap(function(data_uri) {
                // display results in page
                document.getElementById('results').innerHTML =
                    '<img id="imageprev" src="' + data_uri + '"/>';
            });

            Webcam.reset();
        }

        function saveSnap() {
            // Get base64 value from <img id='imageprev'> source
            var base64image = document.getElementById("imageprev").src;

            Webcam.upload(base64image, 'upload.php', function(code, text) {
                console.log('Save successfully');
                //console.log(text);
            });

        }
    </script>