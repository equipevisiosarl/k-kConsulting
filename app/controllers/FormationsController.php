<?php
namespace app\controllers;
use phpFx\routerFx\ControllerMain;

class FormationsController extends ControllerMain {
  public const FORMATIONS  = [
    [
      'photo' => 'assets/img/events-1.jpg',
      'titre' => 'Formation Agrée FDFP',
      'description' => 'lorem ipsum dolor sit amet, consectetur adip euismod sit amet, sed diam nonumy eirmod tempor incididunt ut labore et d Prometheus du placerate con laoreet',
    ],
    [
      'photo' => 'assets/img/events-1.jpg',
      'titre' => 'Coaching et Management',
      'description' => 'lorem ipsum dolor sit amet, consectetur adip euismod sit amet, sed diam nonumy eirmod tempor incididunt ut labore et d Prometheus du placerate con laoreet',
    ],
    [
      'photo' => 'assets/img/events-1.jpg',
      'titre' => 'Formations certifiantes',
      'description' => 'lorem ipsum dolor sit amet, consectetur adip euismod sit amet, sed diam nonumy eirmod tempor incididunt ut labore et d Prometheus du placerate con laoreet',
    ],
    [
      'photo' => 'assets/img/events-1.jpg',
      'titre' => 'Séminaire de formation leadership',
      'description' => 'lorem ipsum dolor sit amet, consectetur adip euismod sit amet, sed diam nonumy eirmod tempor incididunt ut labore et d Prometheus du placerate con laoreet',
    ]
  ];
  public function index(){
    $formations = self::FORMATIONS;
    loadView('pages/formations', compact('formations'));
  }
}
