 <?php  
 $accueil = [
    'path' => '',
    'name' => 'Acceuil',
    'type' => 'single',
 ];

 $qsn = [
    'path' => 'a-propos/qui-sommes-nous',
    'name' => 'Qui sommes nous',
 ];
 $equipe = [
    'path' => 'a-propos/equipe',
    'name' => 'Equipe',
 ];
 $consultants = [
    'path' => 'a-propos/consultants',
    'name' => 'Consultants',
 ];
 $partenariat = [
    'path' => 'a-propos/partenariat',
    'name' => 'Partenairiat',
 ];
 $a_propos = [
    'path' => 'a-propos',
    'name' => 'A propos',
    'type' => 'dropdown',
    'items' => [$qsn, $equipe, $consultants, $partenariat],
 ];

 $formations_certifiante =[
    'path' => 'formations/formations-certifiante',
    'name' => 'Formations Certifiante',
 ];
 $coaching =[
    'path' => 'formations/coaching',
    'name' => 'Coaching',
 ];
 $formations_fdfp =[
    'path' => 'formations/formations-FDFP',
    'name' => 'Formations FDFP',
 ];
 $seminaires =[
    'path' => 'formations/seminaires',
    'name' => 'Seminaires',
 ];
 $formations = [
    'path' => 'formations',
    'name' => 'Formations',
    'type' => 'dropdown',
    'items' => [$formations_certifiante, $coaching, $formations_fdfp, $seminaires],
 ];

 $realisations = [
    'path' => 'realisations',
    'name' => 'Realisations',
    'type' => 'single',
 ];

 $contact = [
    'path' => 'contact',
    'name' => 'Contact',
    'type' => 'single',
 ];

 $menus = [$accueil, $a_propos, $formations, $realisations, $contact]
 
 ?>
 
 <!-- ======= Header ======= -->
 <header id="header" class="fixed-top">
     <div class="container d-flex align-items-center">

         <!-- <h1 class="logo me-auto"><a href="index.html"></a></h1>-->
         <!-- Uncomment below if you prefer to use an image logo -->
         <a href="<?= URL  ?>" class="logo me-auto"><img src="<?= WEBSITE_LOGO ?>" alt="" class="img-fluid"></a>

         <nav id="navbar" class="navbar order-last order-lg-0">
             <ul>
                 <?php foreach ($menus as $menu) : (explode('/',get_url())[0] == $menu['path']) ? $active = 'active' : $active = '' ?>

                     <?php if ($menu['type'] == 'single') : ?>
                         <li><a class="<?= $active  ?>" href="<?= URL.$menu['path']  ?>"><?= $menu['name']  ?></a></li> 
                     <?php else : ?>

                         <li class="dropdown <?= $active  ?>"><a href="#"><span><?= $menu['name']  ?></span> <i class="bi bi-chevron-down"></i></a>
                             <ul>
                                 <?php foreach ($menu['items'] ?? [] as $item) :  ?>
                                 <li><a href="<?=URL. $item['path']  ?>"><?= $item['name']  ?></a></li>
                                 <?php endforeach  ?>
                             </ul>
                         </li>

                     <?php endif  ?>
                 <?php endforeach  ?>
             </ul>
             <i class="bi bi-list mobile-nav-toggle"></i>
         </nav><!-- .navbar -->

        <!-- <a href="courses.html" class="get-started-btn">Get Started</a>-->

     </div>
 </header><!-- End Header -->