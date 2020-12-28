<h1>Halo ini halaman bantuan</h1>

<div class="accordion" id="accordionExample">
    <?php

    $queryBantuan = "SELECT jenis_bantuan FROM bantuan ";
    $menu = $this->db->query($queryBantuan)->result_array();

    ?>
    <?php foreach ($menu as $m) : ?>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <?= $m['jenis_bantuan']; ?>
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <strong>This is the first item's accordion body.</strong> It is hidden by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>