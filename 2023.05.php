<?php

require_once 'slide.php';

$teams = array(
               // Name => (number, number of members, flair)
               // Available flairs: <small>, <blue>, <smallblue>
               'Rattmuffarna'                 => array('0', 6),
               'Viktat Projektivt Rum'        => array(1, 5),
               'Webus Express'                => array('1,2', 9),
               'Enar Åkered'                  => array(2, 9),
               'RRL för Claes Elfsberg'       => array(3, 6),
               'Så att säga'                  => array(4, 3,'<small>'),
               'Senaste Laget'                => array(5, 7),
               'Rebussen'                     => array(6, 6),
               'Ibsens Kusiner'               => array(7, 9),
               'Sötgötarna'                   => array(8, 9),
               'Öset Luhring'                 => array(9, 7),
               'Trial & Error'                => array(10, 7),
               'StaBilen'                     => array(12, 5,'<small>'),
               'Puh - Det mörka hotet'        => array(13, 4,'<small>'),
               'Släkten är färst'             => array(14, 3,'<smallblue>'),
               'Blodbussen'                   => array(112, 9)
               );

// Blåbärsrebusar
$bluerebus = array();

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
    'P GTA' => 'Achievements',
    'P ÖST' => 'Family five',
    'P DIO' => 'Tunggung',
    'P ADD' => 'Sumplete',
    'P MAT' => 'Filmat',
    'P GUB' => 'Filmgubbar',
    'P PAO' => 'Paolo Roberto är ingen fågel',
    'P KAT' => 'KATlas Kompisar',

    // Lunchpyssel
    'P OLW' => 'Chipspromenad',
    'P 1X2' => 'Tipspromenad',

    // Pyssel förmiddag
    'P KRY' => 'Musikkryss',
    'P TIT' => 'Fågellag',
    'P REF' => 'Reflektioner kring konst',
    'P MIX' => 'Hybrider',
    'P HOM' => 'Homografer',
    'P EBU' => 'Eurovision FOMO',

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
    'TP 9' => 'Tallrikstema',

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
    '*picture*Rebusrally 2023-05:logga_stor.png',
    //'*picture*Start:start.jpg',

    'Etapp 1' => array('Tid S', 'R 1', 'P KRY', 'P TIT', 'TP 1', 'FP 1'),

    'Etapp 2' => array('R 2', 'P REF', 'P MIX', 'TP 2', 'FP 2'),
    'Totalt efter Etapp 2' => array('*sumcomp*', 'Etapp 1', 'Etapp 2'),

    'Etapp 3' => array('R 3', 'P GTA', 'P ÖST', 'TP 3', 'FP 3'),
    'Totalt efter Etapp 3' => array('*sumcomp*', 'Totalt efter Etapp 2', 'Etapp 3'),

    'Etapp 4' => array('R 4', 'P DIO',
      '*picture*Öset Luhring:oset.jpg',
      '*picture*Så att säga:sas.jpg',
      '*picture*StaBilen:stabilen.jpg',
      '*picture*Viktat Projektivt Rum:viktatprojektivtrum.jpg',
      '*picture*Blodbussen:blodbussen.jpg',
      '*picture*Enar Åkered:enar.jpg',
      '*picture*Ibsens Kusiner:ibsen.jpg',
      '*picture*Puh - Det mörka hotet:puh.jpg',
      '*picture*Rebussen:rebussen.jpg',
      '*picture*RRL för Claes Elfsberg:rrl.jpg',
      '*picture*Sötgötarna:sotgotarna.jpg',
      '*picture*Webus Express:webus.jpg',
      'P EBU',
      'TP 4', 'FP 4', 'Tid L'),
    'Totalt efter Etapp 4' => array('*sumcomp*', 'Totalt efter Etapp 3', 'Etapp 4'),

    'Lunch' =>
    array(
          //'*picture*Lunch:lunch.jpg',
        'P OLW',
        'P 1X2',
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

    'Etapp 5' => array('R 5', 'P ADD', 'TP 5', 'FP 5'),
    'Totalt efter Etapp 5' => array('*sumcomp*', 'Totalt efter Lunch', 'Etapp 5'),

    'Etapp 6' => array('R 6', 'P GUB', 'P PAO', 'TP 6', 'FP 6'),
    'Totalt efter Etapp 6' => array('*sumcomp*', 'Totalt efter Etapp 5', 'Etapp 6'),

    'Etapp 7' => array('R 7', 'P KAT', 'P HOM', 'TP 7', 'FP 7'),
    'Totalt efter Etapp 7' => array('*sumcomp*', 'Totalt efter Etapp 6', 'Etapp 7'),

    'Etapp 8' => array('R 8', 'P MAT', 'TP 8', 'TP 9', 'FP 8', 'Tid M'),

    '*picture*Prisutdelning:prisutdelning.jpg',

    //'*picture*Karta:karta.jpg',

    // Stilpris
    '*picture*Stilpriset:Stilochfiness.jpg',
    //'*picture*1 till 2 till:stil.jpg',
    //'*picture*Blodpåse:blod.jpg',
    '*sorted*Stil',

    // Plockpris
    '*picture*Bästa plockare:plockpris.jpg',
    'Plock totalt' =>
    array('*sum*',
          'TP 1', 'TP 2', 'TP 3', 'TP 4', 'TP 5', 'TP 6', 'TP 7', 'TP 8',
          'TP 9',
          'FP 1', 'FP 2', 'FP 3', 'FP 4', 'FP 5', 'FP 6', 'FP 7', 'FP 8',
          'ÖppPlk', 'StjPlk'),

    // Pysselpriset
    '*picture*Pysselpriset:pysselpris.jpg',
    'Pyssel totalt' =>
    array('*sum*',
    'P GTA', 'P ÖST', 'P DIO', 'P ADD', 'P MAT', 'P GUB', 'P PAO', 'P EBU',
    'P KAT', 'P OLW', 'P 1X2', 'P KRY', 'P TIT', 'P REF', 'P MIX', 'P HOM'),

    // Rebuspriset
    '*picture*Rebuspriset:rebuspris.jpg',
    'Rebusar totalt' =>
    array('*sum*',
          'ÖppReb', 'S 1', 'S 2', 'S 3', 'S 4',
          'S 5', 'S 6', 'S 7', 'S 8', 'S 9', 'S 10', 'S 11', 'S 12',
          'R 1', 'R 2', 'R 3', 'R 4',
          'R 5', 'R 6', 'R 7', 'R 8'),
    '*picture*Blåbärsrebuspriset:blåbärsrebus.jpg',
    'Rebusar totalt (Blåbärspris)' =>
    array('*sum*','ÖppReb', 'S 1', 'S 2', 'S 3', 'S 4',
          'S 5', 'S 6', 'S 7', 'S 8', 'S 9', 'S 10', 'S 11', 'S 12',
          'R 1', 'R 2', 'R 3', 'R 4',
          'R 5', 'R 6', 'R 7', 'R 8'),

    '*picture*Färstapriset:Förstapriset.jpg',
    'Totalt' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8', 'Stil'),
    '*picture*Ständiga tvåan:Andrapriset.jpg',
    'Ständiga tvåan' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8', 'Stil'),
    '*picture*Blåbärspriset:Blåbärspris.jpg',
    'Blåbärspriset' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8', 'Stil'),
    '*picture*Bästa småbil:Småbilspris.jpg',
    'Bästa småbil' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8', 'Stil'),
    '*picture*Bästa utlänska lag:utlänsktlag.jpg',
    'Bästa utlänska lag' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8', 'Stil'),
    '*picture*Mittenpriset:mittenpriset.jpg',
    'Mittenpriset' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8', 'Stil'),
    '*picture*SaS kula på en pinne:saskula.jpg',
    '*picture*Backpriset:Backpris.jpg',
    '*picture*Backpriset - Katlas Kompisar:backpris_katla.jpg',
    '*picture*Sura trean:SuraTrean.jpg',
    'Sura trean' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8', 'Stil'),
    '*picture*Läggarpinnen:pinne.jpg'
    );

$maxPoints =
  array(
    'P GTA' => 20, # 20 frågor
    'P ÖST' => 25, # 21 frågor
    'P DIO' => 20, # 20 frågor, bonusminusprick
    'P ADD' => 20, # 20 prickar på 7 bräden
    'P MAT' => 20, # 20 frågor
    'P GUB' => 25, # 25 frågor
    'P PAO' => 20, # 20 frågor
    'P KAT' => 20, # 20 frågor
    'P KRY' => 25, # 24 frågor
    'P TIT' => 18, # 9x2 frågor
    'P REF' => 20, # 20 frågor
    'P MIX' => 20, # 20 frågor
    'P HOM' => 19, # 19 frågor
    'P OLW' => 16, # 8x2 frågor
    'P 1X2' => 13, # 19 frågor
    'P EBU' => 24, #12x2 frågor
  );

$info =
  array(
        'P GTA' => '<red>1 per fel',
        'P ÖST' => '<red>1 per fel',
        'P DIO' => '<red>1 per fel, -? för fin bild',
        'P ADD' => '<red>Se formulär',
        'P MAT' => '<red>1 per fel',
        'P GUB' => '<red>1 per fel, \"fel\" gubbe kan ge poäng om den också är rätt, men bägge filmer måste vara rätt',
        'P PAO' => '<red>1 per fel',
        'P KAT' => '<red>1 per fel',
        'P KRY' => '<red>1 per fel',
        'P TIT' => '<red>1 per fel',
        'P REF' => '<red>1 per fel',
        'P MIX' => '<red>1 per fel',
        'P HOM' => '<red>1 per fel',
        'P OLW' => '<red>1 per fel',
        'P 1X2' => '<red>1 per fel',
        'P EBU' => '<red>1 per fel',

        'P .*' => '1 per fel',
        'ÖppReb' => '40',
        'ÖppPlk' => '80',
        'StjPlk' => '-10 per bild',
        'Tid S' => '1 per minut',
        'Tid L' => '1 per minut',
        'Tid M' => '1 per minut, 2 efter 17:30',
        'R [0-9]+' => '25 klippt hjälp, 45 klippt nöd',
        'S [0-9]+' => '-10 korrekt motiverad lösning',
        'FP [0-9]+' => '10 missat plock, 20 falskt plock',
        'TP 9' => '-5 per korrekt tema',
        'TP [0-9]+' => '5 missat plock, 10 falskt plock'
        );
?>
