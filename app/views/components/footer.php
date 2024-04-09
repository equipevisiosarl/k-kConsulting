
 
 <!-- ======= Footer ======= -->
 <footer id="footer">

<div class="footer-top">
  <div class="container">
    <div class="row">

      <div class="col-lg-3 col-md-6 footer-contact">
        <h3><?= WEBSITE_NAME  ?></h3>
        <p>
         <?= WEBSITE_ADDRESS  ?> <br>
          <strong>Phone 1:</strong> <?= WEBSITE_NUM  ?><br>
          <strong>Phone 2:</strong> <?= WEBSITE_NUM2  ?><br>
          <strong>Email:</strong> <?=  WEBSITE_EMAIL ?><br>
        </p>
      </div>

      <div class="col-lg-2 col-md-6 footer-links">
        <h4>Liens Utiles</h4>
        <ul>
          <?php

                                    use app\controllers\FormationsController;

 foreach($liens_utiles as $liens) : ?>
          <li><i class="bx bx-chevron-right"></i> <a href="<?= $liens['lien']  ?>"><?= $liens['name']  ?></a></li>
          <?php endforeach  ?>
        </ul>
      </div>

      <div class="col-lg-3 col-md-6 footer-links">
        <h4>Nos Formations</h4>
        <ul>
          <?php foreach(FormationsController::FORMATIONS as $formation) : ?>
          <li><i class="bx bx-chevron-right"></i> <a href="<?= URL  ?>formations"><?= $formation['titre']  ?></a></li>
          <?php endforeach  ?>
        </ul>
      </div>

      <div class="col-lg-4 col-md-6 footer-newsletter">
        <h4>Joindre Notre Newsletter</h4>
        <form action="" method="post">
          <input type="email" name="email"><input type="submit" value="Subscribe">
        </form>
      </div>

    </div>
  </div>
</div>

<div class="container d-md-flex py-4">

  <div class="me-md-auto text-center text-md-start">
    <div class="copyright">
      &copy; Copyright <strong><span><?= WEBSITE_NAME  ?></span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Make by <a href="https://visiotechsarl.com/">Visiotech Sarl</a>
    </div>
  </div>
  <div class="social-links text-center text-md-right pt-3 pt-md-0">
    <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
    <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
    <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
    <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
    <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
  </div>
</div>
</footer><!-- End Footer -->