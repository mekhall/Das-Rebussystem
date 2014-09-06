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

    'ÖppPlk' => 'Öppnat stjälpplockkuvertet',
    'StjPlk' => 'Stjälpplock',

    // Heldagspyssel
    'P BOK' => 'Bookie Wookie',
    'P BAJ' => 'Skitpyssel',
    'P FOT' => 'Historiska foton',
    'P ASS' => 'Associationsrebusar',
    'P MAT' => 'Matiga hen',
    'P SPO' => 'Sportfrågan',
    'P SUB' => 'Undervattenshörförståelse',

    // Förmiddagspyssel
    'P VIP' => 'Namnge kändisen',
    'P MUS' => 'Musikkrysset',

    // Lunchpyssel
    'P FEM' => 'Finn fem fel',
    'P KRY' => 'Sätt krydda på tillvaron',

    // Eftermiddagspyssel
    'P BIO' => 'Biofilmer',
    'P BON' => 'Tur med vädret',
    'P PUP' => 'Name the pup',

    // Stjälppyssel
    'P POP' => 'Påvar',
    'P MAL' => 'Single-malt',
    'P BIL' => 'Bildrebusar',
    'P ZOM' => 'Zombiekrysset',
    'P YOU' => 'Gissa Youtubekändisen',
    'P JAP' => 'Japanska pyssel',
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

    'Etapp 2' => array('R 2', 'P FOT', 'P ASS', 'TP 2', 'FP 2'),
    'Totalt efter Etapp 2' => array('*sumcomp*', 'Etapp 1', 'Etapp 2'),

    'Etapp 3' => array('R 3', 'P MAT', 'P SPO', 'TP 3', 'FP 3'),
    'Totalt efter Etapp 3' => array('*sumcomp*', 'Totalt efter Etapp 2', 'Etapp 3'),

    'Etapp 4' => array('R 4', 'P SUB', 'P VIP', 'P MUS', 'TP 4', 'FP 4', 'Tid L'),
    'Totalt efter Etapp 4' => array('*sumcomp*', 'Totalt efter Etapp 3', 'Etapp 4'),

    'Lunch' =>
    array('*picture*Lunch:lunch.jpg',
          'P FEM', 'P KRY',
          'ÖppPlk', 'StjPlk',
          array('*esum*', 'Stjälpplock totalt', 'StjPlk', 'ÖppPlk'),
          'ÖppReb',
          'S 1', 'S 2', 'S 3', 'S 4', 'S 5', 'S 6', 'S 7',
          'S 8', 'S 9', 'S 10', 'S 11', 'S 12',
          array('*esum*', 'Stjälprebusar totalt',
                'ÖppReb',
                'S 1', 'S 2', 'S 3', 'S 4', 'S 5',
                'S 6', 'S 7', 'S 8', 'S 9', 'S 10', 'S 11', 'S 12')),
    'Totalt efter Lunch' => array('*sumcomp*', 'Totalt efter Etapp 4', 'Lunch'),

    'Etapp 5' => array('R 5', 'P BIO', 'P BON', 'TP 5', 'FP 5'),
    'Totalt efter Etapp 5' => array('*sumcomp*', 'Totalt efter Lunch', 'Etapp 5'),

    'Etapp 6' => array('R 6', 'P PUP', 'TP 6', 'FP 6'),
    'Totalt efter Etapp 6' => array('*sumcomp*', 'Totalt efter Etapp 5', 'Etapp 6'),

    'Etapp 7' => array('R 7', 'TP 7', 'FP 7'),
    'Totalt efter Etapp 7' => array('*sumcomp*', 'Totalt efter Etapp 6', 'Etapp 7'),

    'Stjälppyssel' => array('ÖppPyss', 'P POP', 'P MAL', 'P BIL', 'P ZOM', 'P YOU', 'P JAP'),

    'Totalt efter stjälppyssel' => array('*sum*', 'Totalt efter Etapp 7', 'Stjälppyssel'),

    'Etapp 8' => array('R 8', 'TP 8', 'FP 8', 'Tid M'),

    'Stil',

    'Plock totalt' =>
    array('*sum*',
          'TP 1', 'TP 2', 'TP 3', 'TP 4', 'TP 5', 'TP 6', 'TP 7', 'TP 8',
          'FP 1', 'FP 2', 'FP 3', 'FP 4', 'FP 5', 'FP 6', 'FP 7', 'FP 8',
          'ÖppPlk', 'StjPlk'),

    'Pyssel totalt' =>
    array('*sum*',
          'P BOK', 'P BIO', 'P BAJ', 'P FOT',
          'P ASS', 'P BON', 'P MAT', 'P VIP',
          'P PUP', 'P SPO', 'P FEM', 'P KRY',
          'P MUS', 'P SUB',
          'ÖppPyss', 'P POP', 'P MAL', 'P BIL', 'P ZOM', 'P YOU', 'P JAP'),

    'Rebusar totalt' =>
    array('*sum*',
          'ÖppReb', 'S 1', 'S 2', 'S 3', 'S 4',
          'S 5', 'S 6', 'S 7', 'S 8', 'S 9', 'S 10', 'S 11', 'S 12',
          'R 1', 'R 2', 'R 3', 'R 4',
          'R 5', 'R 6', 'R 7', 'R 8'),

    'Totalt' => array('*sum*', 'Totalt efter stjälppyssel', 'Etapp 8', 'Stil')
    );

$maxPoints =
  array(
    'P BOK' => 0,
    'P BIO' => 11,
    'P BAJ' => 10,
    'P FOT' => 0,
    'P ASS' => 12,
    'P BON' => 10,
    'P MAT' => 14,
    'P VIP' => 10,
    'P PUP' => 15,
    'P SPO' => 18,
    'P FEM' => 20,
    'P KRY' => 20,
    'P MUS' => 20,
    'P SUB' => 13,
    'P POP' => -20,
    'P MAL' => -20,
    'P BIL' => -24,
    'P ZOM' => -22,
    'P YOU' => 0,
    'P JAP' => -20
  );

$info =
  array(
        'P FEM' => '<red>tio alternativ, 2 per fel',
        'P KRY' => '<red>2 per fel',
        'P ZOM' => '<red>2 per fel',
        'P POP' => '<red>-1 per rätt',
        'P MAL' => '<red>-1 per rätt',
        'P BIL' => '<red>-1 per rätt',
        'P ZOM' => '<red>-1 per rätt poster, -1 per rätt titel',
        'P YOU' => '<red>-1 per rätt',
        'P JAP' => '<red>-5 per korrekt pyssel',
        'P .*' => '1 per fel',
        'ÖppReb' => '4 per medlem = <4p>',
        'ÖppPlk' => '4 per medlem = <4p>',
        'ÖppPyss' => '4 per medlem = <4p>',
        'StjPlk' => '-10 per plock',
        'Tid S' => '1 per minut',
        'Tid L' => '1 per minut',
        'Tid M' => '1 per minut, 2 efter 17:45, 4 efter 18:15, 8 efter 18:45',
        'R [0-9]+' => '25 klippt hjälp, 45 klippt nöd, felaktiga kontrollbokstäver 25',
        'S [0-9]+' => '-10 korrekt motiverad lösning',
        'FP [0-9]+' => '10 missat plock, 20 falskt plock',
        'TP [0-9]+' => '5 missat plock, 10 falskt plock'
        );
?>
