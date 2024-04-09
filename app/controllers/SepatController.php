<?php

namespace app\controllers;

use phpFx\routerFx\ControllerMain;

class SepatController extends ControllerMain
{
  public function index()
  {
    $infos = [
      'Projet' => 'SEPAT',
      'Modules' => 6,
      'Cibles' => 'Etudiants entrepreneurs',
      'Initiateurs' => WEBSITE_NAME
    ];
    $modules = [
      'LE MINDSET DE L’ENTREPRENEUR',
      'LE DESIGN THINKING ',
      'BUSINESS MODEL CANVAS',
      'BUSINESS PLAN',
      'COMMENT TROUVER DU FINANCEMENT POUR LANCER SON PROJET ? ',
      'L’ART DE VENDRE'
    ];
    $content_modules = [
      [
        'titre' => $modules[0],
        'content' => "Tout entrepreneur doit avoir un Mindset (Esprit) fort. 
        A travers ce module, il sera question d’aider les entrepreneurs à développer ce Mindset à travers les étapes et les notions suivantes :
        Le développement d’une mentalité de croissance en voyant les obstacles comme des opportunités d'apprendre et de grandir. L’élaboration d’une vision de leur entreprise et de leur avenir. Être résiliant en faisant face à l'adversité et en étant capable de se relever après une défaite. Développer de la passion pour ce qu'ils font et apprendre à gérer le temps et les priorités.
        ",
        'photo' => 'assets/img/course-details-tab-1.png',
      ],
      [
        'titre' => $modules[1],
        'content' => 'Ce terme est utilisé pour désigner l’ensemble des méthodes et des outils qui aident, face à un problème ou un projet d’in- novation. Il permet d’appliquer la même démarche que celle qu’aurait un designer. Comment transformer ses idées et ses projets en actions réelles et en prototypes tangibles ? la formatrice par sa présentation nous permettra de répondre à cette question. Les participants auront à s’approprier la démarche et l’appliquer à leurs idées de projet.',
        'photo' => 'assets/img/course-details-tab-2.png',
      ],
      [
        'titre' => $modules[2],
        'content' => 'Concevoir un document qui viendra synthétiser le modèle économique de votre entreprise n’est pas toujours tâche facile, ce module nous facilitera la conception de cet outil qui se révèle plus synthétique et beaucoup plus visuelle. Cette formation permettra aux participants de concevoir le modèle économique de leurs projets et qui leur servira de ligne directive.',
        'photo' => 'assets/img/course-details-tab-3.png',
      ],
      [
        'titre' => $modules[3],
        'content' => 'As-tu un business plan ? telle est la question que posent plusieurs apporteurs de capitaux sollicités pour le financement des projets, mais nous constatons que plusieurs porteurs de projet n’en disposent pas soit par méconnaissance soit par négligence.
        Cette formation donnera aux participants des outils efficaces pour leur permettre d’élaborer leurs plans d’affaires de sorte à être toujours prêt à répondre positivement à la question susmentionnée
        ',
        'photo' => 'assets/img/course-details-tab-4.png',
      ],
      [
        'titre' => $modules[4],
        'content' => 'Après avoir clarifié son idée de projet à travers le design thinking, défini son modèle économique à travers le business model canvas et élaboré son plan d’affaires, cette formation vient définir les méthodes et moyens pour accéder aux financements dont bon nombre n’ont pas connaissance. Cette formation ',
        'photo' => 'assets/img/course-details-tab-5.png',
      ],
      [
        'titre' =>$modules[5],
        'content' => 'La vente est un art, il faut être un artiste pour vendre
        Pour pérenniser son entreprise aujourd’hui avec la croissance de la concurrence, tout entrepreneur est amené à bien vendre pour se maintenir sur le marché.
        Le formateur mettra tous les outils nécessaires à la disposition des participants afin d’accroître leurs profits. Cette formation aidera les participants à s’approprier des techniques nécessaires pour vendre leurs produits et booster leur chiffre d’affaire.
        ',
        'photo' => 'assets/img/course-details-tab-1.png',
      ],
    ];
    loadView('pages/sepat', compact('infos', 'modules', 'content_modules'));
  }
}
