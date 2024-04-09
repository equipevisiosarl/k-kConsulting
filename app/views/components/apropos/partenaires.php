<?php
$partenaires = [
    [
        'name' => 'partenaire 1',
        'logo' => 'assets/img/partenaires/logo.jpg'
    ],
    [
        'name' => 'partenaire 2',
        'logo' => 'assets/img/partenaires/logo.jpg'
    ],
    [
        'name' => 'partenaire 3',
        'logo' => 'assets/img/partenaires/logo.jpg'
    ],
    [
        'name' => 'partenaire 4',
        'logo' => 'assets/img/partenaires/logo.jpg'
    ],
    [
        'name' => 'partenaire 5',
        'logo' => 'assets/img/partenaires/logo.jpg'
    ]
]
?>

<!-- ======= Clients Section ======= -->
<section id="clients" class="clients">
    <div class="container" data-aos="fade-up">

        <?= sectionTitle('Partenaires', 'Partenaires')  ?>

        <div class="clients-slider swiper">
            <div class="swiper-wrapper align-items-center">
                <?php foreach ($partenaires as $partenaire) : ?>
                    <div class="swiper-slide"><img src="<?= $partenaire['logo']  ?? "" ?>" class="img-fluid" alt="">
                    <?=  $partenaire['name'] ?? "" ?>
                </div>
                <?php endforeach  ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>

    </div>
</section>
<!-- End Clients Section -->