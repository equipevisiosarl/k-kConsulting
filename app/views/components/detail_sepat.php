<section id="course-details" class="course-details">
    <div class="container" data-aos="fade-up">

        <div class="row">
            <div class="col-lg-8">
                <img src="assets/img/course-details.jpg" class="img-fluid" alt="">
                <h3>Contexte et Justification</h3>
                <p>
                    Notre pays (la Côte d’Ivoire) regorge de nombreuses richesses et un fort potentiel humain très jeune mais nous constatons que ces jeunes ont une grande difficulté d’insertion professionnelle. L’enquête annuelle réalisée par l’agence Ecofine en 2019 a permis de constater qu’en 2018, 67% des 9959 diplômés enquêtés étaient sans emploi. Un chiffre qui inquiète les autorités du pays. C’est en ces réalités que le Cabinet K&K Consulting avec sa grande vision initie le projet School Entrepreneurship Project for Africa Transformation (SEPAT) en vue de contribuer à l’employabilité des jeunes étudiants et récents diplômés en Côte d’Ivoire.
                </p>
                <p>
                    Ce projet fut implémenté de Mai à Novembre 2023 avec plus de 41 personnes formées composé d’étudiants et de récents diplômés. Ces formations qui étaient à la fois théoriques et beaucoup plus pratiques ont pu donner l’opportunité à nos apprenants de pouvoir peaufiner leurs projets, de réaliser leurs plans d’affaires voire même de démarrer leurs projets.
                </p>
                <p>
                    Dans l’objectif de pouvoir ainsi récompenser les meilleurs projets et de lancer la deuxième édition du SEPAT, une journée dédiée à l’étudiant entrepreneur doit être organisée en ce sens où nous pourront à nouveau évoquer le bienfait de l’entrepreneuriat et nous aurons de nouvelles cibles qui participeront à nos formations et un diner gala qui verra récompensé les meilleurs projets, les partenaires et collaborateurs du SEPAT.
                </p>
                <p>
                    Le Cabinet K&K Consulting veut contribuer à impacter les jeunes étudiants et récents diplômés, éveiller le potentiel entrepreneurial en ces jeunes et leur faciliter la création de leurs propres emplois. Ce projet de formation comprend une première étape qui est la conférence de lancement, ensuite un mois de formation théorique et deux mois de formation pratique et enfin un coaching pour soutenir les clubs entrepreneurials dans la réalisation de leurs objectifs.
                </p>
            </div>
            <div class="col-lg-4">
                <?php foreach($infos as $index => $info) : ?>
                <div class="course-info d-flex justify-content-between align-items-center">
                    <h5><?= $index  ?></h5>
                    <p><a href="#"><?= $info ?></a></p>
                </div>
                <?php  endforeach ?>
            </div>
        </div>

    </div>
</section><!-- End Cource Details Section -->

<!-- ======= Cource Details Tabs Section ======= -->
<section id="cource-details-tabs" class="cource-details-tabs">
    <div class="container" data-aos="fade-up">

        <div class="row">
            <div class="col-lg-3">
                <ul class="nav nav-tabs flex-column">
                    <?php foreach($modules as $index => $module) : ?>
                        <?php ($index == 0 ) ? $active = 'active show' : $active = '' ?>
                    <li class="nav-item">
                        <a class="nav-link <?= $active  ?>" data-bs-toggle="tab" href="#tab-<?= $index  ?>"><?=  $module ?></a>
                    </li>
                    <?php endforeach  ?>
                </ul>
            </div>
            <div class="col-lg-9 mt-4 mt-lg-0">
                <div class="tab-content">
                    <?php foreach($content_modules as $index => $content) : ?>
                        <?php ($index == 0 ) ? $active = 'active show' : $active = '' ?>
                    <div class="tab-pane <?= $active  ?>" id="tab-<?=  $index ?>">
                        <div class="row">
                            <div class="col-lg-8 details order-2 order-lg-1">
                                <h3><?= $content['titre']  ?></h3>
                                <p><?= $content['content']  ?></p>
                            </div>
                            <div class="col-lg-4 text-center order-1 order-lg-2">
                                <img src="<?= $content['photo']  ?>" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <?php  endforeach ?>
                </div>
            </div>
        </div>

    </div>
</section><!-- End Cource Details Tabs Section -->