<?php

namespace app\controllers;

use phpFx\routerFx\ControllerMain;

class HumainController extends ControllerMain
{
  public function index()
  {
    $TITRE = 'Equipe';
    $DESCRIPTION = 'Description equipe';
    $equipe = [
      [
        'photo' => 'assets/img/trainers/trainer-1.jpg',
        'nom' => 'nom 1',
        'role' => ' role 1'
      ],
      [
        'photo' => 'assets/img/trainers/trainer-2.jpg',
        'nom' => 'nom 2',
        'role' => ' role 2'
      ],
      [
        'photo' => 'assets/img/trainers/trainer-3.jpg',
        'nom' => 'nom 3',
        'role' => ' role 3'
      ]
    ];

    $humains = $equipe;

    loadView('pages/equipe', compact('humains', 'TITRE', 'DESCRIPTION'));
  }

  public function consultants()
  {
    $TITRE = 'Consultants';
    $DESCRIPTION = 'Description consultants';
    $consultants = [
      [
        'photo' => 'assets/img/trainers/trainer-1.jpg',
        'nom' => 'nom 1',
        'role' => ' role 1',
        'description' => 'description 1',
      ],
      [
        'photo' => 'assets/img/trainers/trainer-2.jpg',
        'nom' => 'nom 2',
        'role' => ' role 2',
        'description' => 'description 2',
      ],
      [
        'photo' => 'assets/img/trainers/trainer-3.jpg',
        'nom' => 'nom 3',
        'role' => ' role 3',
        'description' => 'description 3',
      ]
    ];

    $humains = $consultants;

    loadView('pages/equipe', compact('humains', 'TITRE', 'DESCRIPTION'));
  }
}
