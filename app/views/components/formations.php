<!-- ======= Events Section ======= -->
<section id="events" class="events">
    <div class="container" data-aos="fade-up">

        <div class="row">
            <?php foreach ($formations as $formation) : ?>
                <div class="col-md-6 d-flex align-items-stretch"> 
                    <div class="card">
                        <div class="card-img">
                            <img src="<?=  $formation['photo'] ?>" alt="...">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title"><a href="<?=  '../'.get_url() ?>/#"><?=  $formation['titre'] ?></a></h5>
                            <!--<p class="fst-italic text-center">Sunday, September 26th at 7:00 pm</p>-->
                            <p class="card-text"><?=  $formation['description'] ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach  ?>
        </div>

    </div>
</section><!-- End Events Section -->