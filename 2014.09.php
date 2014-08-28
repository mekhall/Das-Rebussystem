<?php

require_once 'slide.php';

$teams = array(
               // Name => (number, number of members, flair)
               'Öset Luhring'           => array(1, 1),
               'Enar Åkered'            => array(2, 1),
               'Katlas kompisar'        => array(3, 1),
               'Sötgötarna'             => array(4, 1),
               'Ibsens kusiner'         => array(5, 1),
               'Så att säga'            => array(6, 1),
               'Webus express'          => array(7, 1),
               '1 till 2 till'          => array(8, 1),
               'RRL för Claes Elfsberg' => array(9, 1),
               'Ingen Aning'            => array(10, 1),
               'Psst!'                  => array(11, 1),
               'Puh - Det mörka hotet'  => array(12, 1),
               'SK2:AIRR'               => array(13, 1),
               'Risk för dåligt väglag' => array(15, 1),
               'Rattmuffarna'           => array(42, 1)
               );

$events = array(
    // Rebusar
    'R 1' => 'Rebus 1',
    'R 2' => 'Rebus 2',
    'R 3' => 'Rebus 3',
    'R 4' => 'Rebus 4',
    'R 5' => 'Rebus 5',
    'R 6' => 'Rebus 6',
    'R 7' => 'Rebus 7',
    'R 8' => 'Rebus 8',

    // Stjälp
    'S 1' => 'Stjälp 1',
    'S 2' => 'Stjälp 2',
    'S 3' => 'Stjälp 3',
    'S 4' => 'Stjälp 4',
    'S 5' => 'Stjälp 5',
    'S 6' => 'Stjälp 6',
    'S 7' => 'Stjälp 7',
    'S 8' => 'Stjälp 8',
    'S 9' => 'Stjälp 9',
    'S 10' => 'Stjälp 10',
    'S 11' => 'Stjälp 11',
    'S 12' => 'Stjälp 12',
    'ÖppReb' => 'Öppnat stjälprebuskuvertet',

    // Heldagspyssel
    'P BOK' => 'Boookie',
    'P BAJ' => 'Skitpyssel',
    'P HIS' => 'Historiska foton',
    'P JAP' => 'Japanska pyssel',
    'P MAT' => 'Matiga hen',
    'P SUB' => 'Undervattenshörförståelse',

    // Förmiddagspyssel
    'P CEL' => 'Namnge kändisen',
    'P MUS' => 'Musikkrysset',

    // Lunchpyssel
    'P FEM' => 'Finn fem fel',
    'P KRD' => 'Sätt krydda på tillvaron',

    // Eftermiddagspyssel
    'P BIO' => 'Biofilmer',
    'P BON' => 'Tur med vädret',
    'P PUP' => 'Name the pup',

    // Stjälppyssel
    'P POP' => 'Påvar',
    'P MAL' => 'Single-malt',
    'P BIL' => 'Bildrebusar',
    'P ZOM' => 'Zombiekrysset',
    'P SOR' => 'Sportfrågan',
    'P ASS' => 'Assoiciationsrebusar',
    'ÖppPyss' => 'Öppnat stjälppysselkuvert',

    'Stil' => 'Stil och finess',
    'Tid S' => 'Tidsprickar vid Start',
    'Tid L' => 'Tidsprickar vid Lunch',
    'Tid M' => 'Tidsprickar vid Mål',
    'TP 1' => 'Tallriksplock 1',
    'TP 2' => 'Tallriksplock 2',
    'TP 3' => 'Tallriksplock 3',
    'TP 4' => 'Tallriksplock 4',
    'TP 5' => 'Tallriksplock 5',
    'TP 6' => 'Tallriksplock 6',
    'TP 7' => 'Tallriksplock 7',
    'TP 8' => 'Tallriksplock 8',
    'FP 1' => 'Fotoplock 1',
    'FP 2' => 'Fotoplock 2',
    'FP 3' => 'Fotoplock 3',
    'FP 4' => 'Fotoplock 4',
    'FP 5' => 'Fotoplock 5',
    'FP 6' => 'Fotoplock 6',
    'FP 7' => 'Fotoplock 7',
    'FP 8' => 'Fotoplock 8'
    );

$parts = array(
    '*picture*Rebusrally 2014-09:trial-error.gif',

    'Etapp 1' => array('Tid S', 'R 1', 'P BOK', 'P BAJ', 'TP 1', 'FP 1'),

    'Etapp 2' => array('R 2', 'P HIS', 'P JAP', 'TP 2', 'FP 2'),
    'Totalt efter Etapp 2' => array('*sumcomp*', 'Etapp 1', 'Etapp 2'),

    'Etapp 3' => array('R 3', 'P MAT', 'P SUB', 'TP 3', 'FP 3'),
    'Totalt efter Etapp 3' => array('*sumcomp*', 'Totalt efter Etapp 2', 'Etapp 3'),

    'Etapp 4' => array('R 4', 'P CEL', 'P MUS', 'TP 4', 'FP 4', 'Tid L'),
    'Totalt efter Etapp 4' => array('*sumcomp*', 'Totalt efter Etapp 3', 'Etapp 4'),

    'Lunch' =>
    array('*picture*Lunch:lunch.jpg',
          'Stil',
          'P FEM', 'P KRD',
          'S 1', 'S 2', 'S 3', 'S 4', 'S 5', 'S 6', 'S 7',
          'S 8', 'S 9', 'S 10', 'S 11', 'S 12',
          array('*esum*', 'Stjälprebusar totalt', 'S 1', 'S 2', 'S 3', 'S 4', 'S 5',
                'S 6', 'S 7', 'S 8', 'S 9', 'S 10', 'S 11', 'S 12')),
    'Totalt efter Lunch' => array('*sumcomp*', 'Totalt efter Etapp 4', 'Lunch'),

    'Etapp 5' => array('R 5', 'P BIO', 'P BON', 'TP 5', 'FP 5'),
    'Totalt efter Etapp 5' => array('*sumcomp*', 'Totalt efter Lunch', 'Etapp 5'),

    'Etapp 6' => array('R 6', 'P PUP', 'P POP', 'TP 6', 'FP 6'),
    'Totalt efter Etapp 6' => array('*sumcomp*', 'Totalt efter Etapp 5', 'Etapp 6'),

    'Etapp 7' => array('R 7', 'P MAL', 'P BIL', 'TP 7', 'FP 7'),
    'Totalt efter Etapp 7' => array('*sumcomp*', 'Totalt efter Etapp 6', 'Etapp 7'),

    'Etapp 8' => array('R 8', 'P ZOM', 'P SOR', 'P ASS', 'TP 8', 'FP 8', 'Tid M'),


    'Plock totalt' =>
    array('*sum*',
          'TP 1', 'TP 2', 'TP 3', 'TP 4', 'TP 5', 'TP 6', 'TP 7', 'TP 8',
          'FP 1', 'FP 2', 'FP 3', 'FP 4', 'FP 5', 'FP 6', 'FP 7', 'FP 8'),

    'Pyssel totalt' =>
    array('*sum*',
          'P BOK',
          'P BAJ',
          'P HIS',
          'P JAP',
          'P MAT',
          'P SUB',
          'P CEL',
          'P MUS',
          'P FEM',
          'P KRD',
          'P BIO',
          'P BON',
          'P PUP',
          'P POP',
          'P MAL',
          'P BIL',
          'P ZOM',
          'P SOR',
          'P ASS'),

    'Alla rebusar' =>
    array('*sum*',
          'S 1', 'S 2', 'S 3', 'S 4',
          'S 5', 'S 6', 'S 7', 'S 8', 'S 9', 'S 10', 'S 11', 'S 12',
          'R 1', 'R 2', 'R 3', 'R 4',
          'R 5', 'R 6', 'R 7', 'R 8'),

    'Totalt' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8')
    );

$maxPoints =
  array(
         );

$info =
  array(
        'P .*' => '1 per fel',
        'ÖppReb' => '4 per medlem = <4p>', 
        'ÖppPyss' => '4 per medlem = <4p>',
        'Tid S' => '1 per minut',
        'Tid L' => '1 per minut',
        'Tid M' => '1 per minut, 2 efter 17:45, 4 efter 18:15, 8 efter 18:45',
        'R [0-9]+' => '25 klippt hjälp, 45 klippt nöd, felaktiga kontrollbokstäver 25',
        'S [0-9]+' => '-10 korrekt motiverad lösning',
        'FP [0-9]+' => '10 missat plock, 20 falskt plock',
        'TP [0-9]+' => '5 missat plock, 10 falskt plock'
        );
?>
