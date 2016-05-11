<?php

require_once 'slide.php';

$teams = array(
               // Name => (number, number of members, flair)
               'Öset Luhring'           => array(1, 1),
               'Trial & Error'          => array(2, 1),
               'Enar Åkered'            => array(3, 1),
               'Rattmuffarna'           => array(4, 1),
               'RRL för Claes Elfsberg' => array(5, 1),
	       'Ibsens kusiner'         => array(6, 1),
	       'Katlas kompisar'        => array(7, 1),
	       'Rebussen'               => array(9, 1),
	       'Webus Excess'           => array(10,1),
	       'Suddens bergsmyntor'    => array(11,1),
	       'Sötgötarna'             => array(12,1),
	       '1 till 2 till'          => array(13,1),
	       'I minsta laget'         => array(14,1),
	       'Risk för Dåligt Väglag' => array(15,1),
	       'Tisdagsfikarna'         => array(16,1),
	       'Spårvägens övermän'     => array(17,1),
	       'Pyjamasparty'           => array(18,1),
	       'Webus Express'          => array(1337,1)
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
    'S 13' => 'Stjälp 13',

    // Heldagspyssel
    'P ORAL' => 'Känn din oralkirurg',
    'P NORD' => 'Årets nyord',
    'P PORT' => 'Porträttpyssel',

    // Förmiddagspyssel
    'P TYAR' => 'Tyskar',
    'P SKÄG' => 'Behåringspysslet',
    'P PISS' => 'Pisslet',
    'P MUSK' => 'Musikkrysset',


    // Lunchpyssel
    'P HPOT' => 'Tipspromenad Harry Potter',
    'P GEOG' => 'Geoguessr-lunchpyssel',
    'P BAJS' => 'Gissa bajset',

    // Eftermiddagspyssel
    'P TALL' => 'Tallriksmodellen',
    'P KUNG' => 'Rojalistpysslet',
    'P ZLAT' => 'Vem är Zlatan Ibrahimovic?',
    'P TYOR' => 'Tyskor',

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
    'FP 8' => 'Fotoplock 8',
    );

$parts = array(
    '*picture*Rebusrally 2016-05:title.jpg',

    'Etapp 1' => array('Tid S', 'R 1', 'P TYAR', 'TP 1', 'FP 1'),

    'Etapp 2' => array('R 2', 'P SKÄG', 'TP 2', 'FP 2'),
    'Totalt efter Etapp 2' => array('*sumcomp*', 'Etapp 1', 'Etapp 2'),

    'Etapp 3' => array('R 3', 'P PISS', 'P ORAL', 'TP 3', 'FP 3'),
    'Totalt efter Etapp 3' => array('*sumcomp*', 'Totalt efter Etapp 2', 'Etapp 3'),

    'Etapp 4' => array('R 4', 'P MUSK', 'TP 4', 'FP 4', 'Tid L'),
    'Totalt efter Etapp 4' => array('*sumcomp*', 'Totalt efter Etapp 3', 'Etapp 4'),

    'Lunch' =>
    array('*picture*Lunch:lunch.jpg',
          'Stil',
          'P HPOT', 'P GEOG', 'P BAJS',
	  '*picture*Rebuspysslet:länsbort.jpg',
          'S 1', 'S 2', 'S 3', 'S 4', 'S 5', 'S 6', 'S 7',
          'S 8', 'S 9', 'S 10', 'S 11', 'S 12', 'S 13', 
          array('*esum*', 'Stjälprebusar totalt', 'S 1', 'S 2', 'S 3', 'S 4', 'S 5',
                'S 6', 'S 7', 'S 8', 'S 9', 'S 10', 'S 11', 'S 12', 'S 13')),
    'Totalt efter Lunch' => array('*sumcomp*', 'Totalt efter Etapp 4', 'Lunch'),

    'Etapp 5' => array('R 5', 'P TALL', 'TP 5', 'FP 5'),
    'Totalt efter Etapp 5' => array('*sumcomp*', 'Totalt efter Lunch', 'Etapp 5'),

    'Etapp 6' => array('R 6', 'P KUNG', 'P NORD', 'TP 6', 'FP 6'),
    'Totalt efter Etapp 6' => array('*sumcomp*', 'Totalt efter Etapp 5', 'Etapp 6'),

    'Etapp 7' => array('R 7', 'P ZLAT', 'P PORT', 'TP 7', 'FP 7'),
    'Totalt efter Etapp 7' => array('*sumcomp*', 'Totalt efter Etapp 6', 'Etapp 7'),

    'Etapp 8' => array('R 8', 'P TYOR', 'TP 8', 'FP 8', 'Tid M'),

    'Plock totalt' =>
    array('*sum*',
          'TP 1', 'TP 2', 'TP 3', 'TP 4', 'TP 5', 'TP 6', 'TP 7', 'TP 8',
          'FP 1', 'FP 2', 'FP 3', 'FP 4', 'FP 5', 'FP 6', 'FP 7', 'FP 8'),

    'Pyssel totalt' =>
    array('*sum*',
         'P ORAL',
         'P NORD',
         'P PORT',
         'P TYAR',
         'P SKÄG',
         'P PISS',
         'P MUSK',
         'P HPOT',
         'P GEOG',
         'P BAJS',
         'P TALL',
         'P KUNG',
         'P ZLAT',
         'P TYOR'
	 ),

    'Alla rebusar' =>
    array('*sum*',
          'S 1', 'S 2', 'S 3', 'S 4',
          'S 5', 'S 6', 'S 7', 'S 8', 'S 9', 'S 10', 'S 11', 'S 12', 'S 13',
          'R 1', 'R 2', 'R 3', 'R 4',
          'R 5', 'R 6', 'R 7', 'R 8'),

    'Totalt' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8')
    );

$maxPoints =
  array(
         'P ORAL' => 1227,
         'P NORD' => 1227,
         'P PORT' => 1227,
         'P TYAR' => 1227,
         'P SKÄG' => 1227,
         'P PISS' => 1227,
         'P MUSK' => 1227,
         'P HPOT' => 1227,
         'P GEOG' => 1227,
         'P BAJS' => 1227,
         'P TALL' => 1227,
         'P KUNG' => 1227,
         'P ZLAT' => 1227,
         'P TYOR' => 1227
         );

$info =
  array(
        'Tid S' => '1 per minut',
        'Tid L' => '1 per minut',
        'Tid M' => '1 per minut, 2 efter 17:45, 4 efter 18:15, 8 efter 18:45',
        'R [0-9]+' => '25 klippt hjälp, 45 klippt nöd, felaktiga kontrollbokstäver 25',
        'S [0-9]+' => '-15 korrekt motiverad lösning',
        'FP [0-9]+' => '10 missat plock, 20 falskt plock',
        'TP [0-9]+' => '5 missat plock, 10 falskt plock'
        );
?>
