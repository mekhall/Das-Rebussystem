<?php

require_once 'slide.php';

$teams = array(
               // Name => (number, number of members, flair)
               'Risk för dåligt väglag' => array(1, 1),
               'Öset Luhring'           => array(2, 1),
               'Knowledge and passion'  => array(3, 1),
               'Trial & Error'          => array(4, 1),
               'Enar Åkered'            => array(5, 1),
               'RRL för Claes Elfsberg' => array(6, 1),
               'Ingen Aning'            => array(7, 1, "<small><blue>"),
               '1 till 2 till'          => array(8, 1),
               'I minsta laget'         => array(9, 1, "<small>"),
               'Rattmuffarna'           => array(10, 1, "<blue>"),
               'Katlas kompisar'        => array(11, 1)
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

    // Heldagspyssel
    'P MUSK' => 'Musikkrysset',
    'P KART' => 'Kartogram',
    'P RAMO' => 'Ramones intron',
    'P FACE' => 'Facepysslet',
    'P POPC' => 'Popstjärnecluedo',
            
    // Förmiddagspyssel
    'P STYS' => 'Stysslet',
    'P LAPP' => 'Lapptäcket', 
            
    // Lunchpyssel
    'P HEMT' => 'Hemmet i närbild',
    'P KORS' => 'Korso',
            
    // Eftermiddagspyssel
    'P SKID' => 'Skidbrudar',
    'P FOTO' => 'Sverigefotoplock',
    'P FOBI' => 'Fobier',
    'P TERJ' => 'Terje',

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
    'Etapp 1' => array('Tid S', 'R 1', 'P MUSK', 'P STYS', 'TP 1', 'FP 1'),

    'Etapp 2' => array('R 2', 'P POPC', 'TP 2', 'FP 2'),
    'Totalt efter Etapp 2' => array('*sumcomp*', 'Etapp 1', 'Etapp 2'),

    'Etapp 3' => array('R 3', 'P LAPP', 'P FOTO', 'TP 3', 'FP 3'),
    'Totalt efter Etapp 3' => array('*sumcomp*', 'Totalt efter Etapp 2', 'Etapp 3'),

    'Etapp 4' => array('R 4', 'P SKID', 'TP 4', 'FP 4', 'Tid L'),
    'Totalt efter Etapp 4' => array('*sumcomp*', 'Totalt efter Etapp 3', 'Etapp 4'),

    'Lunch' => 
    array(new PictureSlide("Lunch", "2012.05/lunch.jpg"),
          'Stil',
          'P HEMT', 'P KORS',
          'S 1', 'S 2', 'S 3', 'S 4', 'S 5', 'S 6', 'S 7',
          'S 8', 'S 9', new SolutionSlide('S', '9Rattmuffarna'),
          'S 10', 'S 11',
          new SumSlide('Stjälprebusar totalt',
                       array('S 1', 'S 2', 'S 3', 'S 4',
                             'S 5', 'S 6', 'S 7', 'S 8', 'S 9', 'S 10', 'S 11'))),
    'Totalt efter Lunch' => array('*sumcomp*', 'Totalt efter Etapp 4', 'Lunch'),

    'Etapp 5' => array('R 5', 'P FOBI', 'TP 5', 'FP 5'),
    'Totalt efter Etapp 5' => array('*sumcomp*', 'Totalt efter Lunch', 'Etapp 5'),

    'Etapp 6' => array('R 6', 'P RAMO', 'P FACE', 'TP 6', 'FP 6'),
    'Totalt efter Etapp 6' => array('*sumcomp*', 'Totalt efter Etapp 5', 'Etapp 6'),

    'Etapp 7' => array('R 7', 'P KART', 'P TERJ', 'TP 7', 'FP 7'),
    'Totalt efter Etapp 7' => array('*sumcomp*', 'Totalt efter Etapp 6', 'Etapp 7'),

    'Etapp 8' => array('R 8', 'TP 8', 'FP 8', 'Tid M'),

    'Plock totalt' => 
    array('*sum*',
          'TP 1', 'TP 2', 'TP 3', 'TP 4', 'TP 5', 'TP 6', 'TP 7', 'TP 8',
          'FP 1', 'FP 2', 'FP 3', 'FP 4', 'FP 5', 'FP 6', 'FP 7', 'FP 8'),

    'Pyssel totalt' => 
    array('*sum*', 
         'P MUSK',
         'P KART',
         'P RAMO',
         'P FACE',
         'P POPC',
         'P STYS',
         'P LAPP',
         'P HEMT',
         'P KORS',
         'P SKID',
         'P FOTO',
         'P FOBI',
         'P TERJ'),

    'Alla rebusar' => 
    array('*sum*',
          'S 1', 'S 2', 'S 3', 'S 4',
          'S 5', 'S 6', 'S 7', 'S 8', 'S 9', 'S 10', 'S 11',
          'R 1', 'R 2', 'R 3', 'R 4',
          'R 5', 'R 6', 'R 7', 'R 8'),

    'Totalt' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8')
    );

$maxPoints = 
  array(
         'P MUSK' => 46,
         'P KART' => 16,
         'P RAMO' => 20,
         'P FACE' => 42,
         'P POPC' => 20,
         'P STYS' => 28,
         'P LAPP' => 22,
         'P HEMT' => 21,
         'P KORS' => 16,
         'P SKID' => 18,
         'P FOTO' => 30,
         'P FOBI' => 16,
         'P TERJ' => 28
         );

$info = 
  array(
        'Tid S' => '1 per minut',
        'Tid L' => '1 per minut',
        'Tid M' => '1 per minut, 2 efter 17:45, 4 efter 18:15, 8 efter 18:45',
        'R [0-9]+' => '25 klippt hjälp, 45 klippt nöd, felaktiga kontrollbokstäver 25',
        'S [0-9]+' => '-10 korrekt motiverad lösning',
        'FP [0-9]+' => '10 missat plock, 20 falskt plock',
        'TP [0-9]+' => '5 missat plock, 10 falskt plock'
        );
?>
