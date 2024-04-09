<!-- ======= Trainers Section ======= -->
<section id="trainers" class="trainers">
    <div class="container" data-aos="fade-up">

        <div class="row">
            <?php foreach ($humains as $humain) :  ?>

                <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                    <div class="d-flex align-items-stretch">
                        <div class="member">
                            <img src="<?= $humain['photo'] ?? 'assets/img/trainers/trainer-1.jpg'  ?>" class="img-fluid" alt="">
                            <div class="member-content">
                                <h4><?= $humain['nom'] ?? '' ?></h4>
                                <span><?= $humain['role'] ?? '' ?></span>
                                <p>
                                    <?= $humain['description'] ?? ''  ?>
                                </p>
                                <!--<div class="social">
                <a href=""><i class="bi bi-twitter"></i></a>
                <a href=""><i class="bi bi-facebook"></i></a>
                <a href=""><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-linkedin"></i></a>
                </div>-->
                            </div>
                        </div>
                    </div>
                </div>

            <?php endforeach  ?>

        </div>

    </div>
</section><!-- End Trainers Section -->