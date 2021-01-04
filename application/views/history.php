<?php
$data['user'] = $this->db->get('profil')->result();
?>


<?php
// query mengambil data bantuan

$queryHistory = "SELECT distinct waktu_transaksi, id_jenis_transaksi FROM history";
$menu = $this->db->query($queryHistory)->result_array();

?>

<nav class="navbar" style="background-color: #683699;">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url('user') ?>"><i class="fa fa-arrow-left fa-2x text-white" aria-hidden=" true"></i> </a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" style="margin-left: 20px;">
                    <h3 class="text-white">OVO - History</h3>
                </a>
            </li>
        </ul>
    </div>
</nav>
<br>

<div class="container-fluid">
    <div class="container">
        <div class="card">
            <?php foreach ($menu as $m) : ?>
                <div class="card-header">
                    <?= $m['waktu_transaksi']; ?>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"><?= $m['id_jenis_transaksi']; ?></th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>