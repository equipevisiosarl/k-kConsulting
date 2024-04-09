 <!-- ======= Contact Section ======= -->
 <section id="contact" class="contact">
     <div data-aos="fade-up">
         <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5637.171574369457!2d-3.937468093084726!3d5.372435239687918!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfc1ebf614fcdd1d%3A0x5362486b6c84eaf3!2sPlayce%20Palmeraie!5e0!3m2!1sfr!2sci!4v1712626293097!5m2!1sfr!2sci" frameborder="0" allowfullscreen></iframe>
     </div>

     <div class="container" data-aos="fade-up">

         <div class="row mt-5">

             <div class="col-lg-4">
                 <div class="info">
                     <div class="address">
                         <i class="bi bi-geo-alt"></i>
                         <h4>Localisation:</h4>
                         <p><?= WEBSITE_ADDRESS  ?></p>
                     </div>

                     <div class="email">
                         <i class="bi bi-envelope"></i>
                         <h4>Email:</h4>
                         <p><?= WEBSITE_EMAIL  ?></p>
                     </div>

                     <div class="phone">
                         <i class="bi bi-phone"></i>
                         <h4>Téléphone:</h4>
                         <p><?= WEBSITE_NUM  ?></p>
                         <p><?= WEBSITE_NUM2  ?></p>
                     </div>

                 </div>

             </div>

             <div class="col-lg-8 mt-5 mt-lg-0">

                 <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                     <div class="row">
                         <div class="col-md-6 form-group">
                             <input type="text" name="name" class="form-control" id="name" placeholder="Votre Nom" required>
                         </div>
                         <div class="col-md-6 form-group mt-3 mt-md-0">
                             <input type="email" class="form-control" name="email" id="email" placeholder="Votre email" required>
                         </div>
                     </div>
                     <div class="form-group mt-3">
                         <input type="text" class="form-control" name="subject" id="subject" placeholder="Objet" required>
                     </div>
                     <div class="form-group mt-3">
                         <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                     </div>
                     <div class="my-3">
                         <div class="loading">Loading</div>
                         <div class="error-message"></div>
                         <div class="sent-message">Your message has been sent. Thank you!</div>
                     </div>
                     <div class="text-center"><button type="submit">Send Message</button></div>
                 </form>

             </div>

         </div>

     </div>
 </section><!-- End Contact Section -->