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
    'name' => 'Partenariat',
 ];
 $a_propos = [
    'path' => 'a-propos',
    'name' => 'A propos',
    'type' => 'dropdown',
    'items' => [$qsn, $equipe, $consultants, $partenariat],
 ];

 
 $formations = [
    'path' => 'formations',
    'name' => 'Formations',
    'type' => 'single',
 ];

 $sepat = [
   'path' => 'sepat',
   'name' => 'SEPAT',
   'type' => 'single',
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

 $menus = [$accueil, $a_propos, $formations, /*$realisations,*/$sepat, $contact];

 $liens_utiles = [
   ['lien'=>$sepat['path'], 'name'=>$sepat['name']],
   ['lien'=>$qsn['path'], 'name'=>$a_propos['name']],
   ['lien'=>$formations['path'], 'name'=>$formations['name']],
   ['lien'=>$realisations['path'], 'name'=>$realisations['name']],
   ['lien'=>$contact['path'], 'name'=>$contact['name']]
 ];
 
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

                         <li class="dropdown <?= $active  ?>"><a href="../#"><span><?= $menu['name']  ?></span> <i class="bi bi-chevron-down"></i></a>
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