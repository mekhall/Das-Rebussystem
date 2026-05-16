<?php

require_once 'slide.php';

$teams = array(
               // Name => (number, number of members, flair)
               // Available flairs: <small>, <blue>, <smallblue>
               'Viktat Projektivt Rum'        => array(1, 9),   //7
               'Enar Åkered'                  => array(2, 9),     //8
               'Skalmans Självgående Skottkärra' => array(3, 9),  //4
               'Webus Express'                => array(4, 9),  //9 
               'Trial & Error'                => array(5, 9),  //8 
               'RRL för Claes Elfsberg'       => array(6, 7),      //7
               'Katlas Kompisar'              => array(7, 9),  //8 
               'Sötgötarna'                   => array(8, 8),// 7
               'PUH - Det mörka hotet'        => array(9, 5,  '<small>'),   // 5
               'Senaste Laget'                => array(10, 8),   //8
               'Så att säga'                  => array(11, 3, '<small>'),  //3
               'Re-Busarna'                   => array(12, 9, '<blue>'),   //0
               'Hellre bred än smal'          => array(13, 9), // 7
               'Bus4us'                       => array(14, 8),  //5
               'Rattmuffarna'                 => array(15, 4, '<small>'),  //4
               'SICKet lag'                   => array(16, 6, '<blue>'),  //0
               'Rebussen'                     => array(17, 5),   //6
               'Ingenjörer på gränsen'        => array(42, 9),   //7
               'Buzzin\''                     => array(83, 9,'<blue>'),  //3
               'Blodbussen'                   => array(112, 9),   //6
               'TBD'                          => array(780, 7));    // 7 

// Blåbärsrebusar
$bluerebus = array();
// Blåbärshjälp
$bluehelprebus = array();

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
    'P FIS' => 'Fiskpinnar',
    'P LIM' => 'Rebusrallylimerick',
    'P BIL' => 'Bildassociation IV',
    'P FIE' => '24 f i e p',
    'P BCQ' => 'Var bor Becquerel?',
    'P BJÖ' => 'Björnzone',
    'P CIR' => 'Cirkulera, här finns inget att se',
    'P BRI' => 'Diamond of the Season',
    
    // Lunchpyssel
    'P VAL' => 'Tipspromenad - Valspecial',
    'P MJÖ' => 'Rent mjöl i påsen',
    
    // Pyssel förmiddag
    'P MUS' => 'Musikkrysset',
    'P OAT' => 'Oates, Yeats, Keats eller Keyes?',
    'P GAM' => 'Gamla-gamla',
    'P TRA' => 'TRAditionsenligt pyssel',

    // Pyssel eftermiddag

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
    '*picture*Rebusrally VT 2026:logga_stor.png',
    //'*picture*Start:start.png',

    'Etapp 1' => array('Tid S', 'R 1', 'P MUS', 'TP 1', 'FP 1'),

    'Etapp 2' => array('R 2', 'P OAT', 
      '*picture*Rebusrallylimerick:limerick.jpg', // Explicit, så den hamnar innan limerickarna
        //'*solution*L3', '*solution*L2', '*solution*L1',
        'P LIM', 'TP 2', 'FP 2'),
    'Totalt efter Etapp 2' => array('*sumcomp*', 'Etapp 1', 'Etapp 2'),

    'Etapp 3' => array('R 3', 
      'P GAM', 
      'P FIS',
      'TP 3', 'FP 3'),
    'Totalt efter Etapp 3' => array('*sumcomp*', 'Totalt efter Etapp 2', 'Etapp 3'),

    'Etapp 4' => array('R 4', 'P TRA', 'TP 4', 'FP 4'),
    'Totalt efter Etapp 4' => array('*sumcomp*', 'Totalt efter Etapp 3', 'Etapp 4'),

    'Lunch' =>
    array(
        '*picture*Lunch:lunch.png',
        'Tid L',
        'P VAL',
        'P MJÖ',
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

    'Etapp 5' => array('R 5', 
      'P BIL', 'P FIE', 'TP 5', 'FP 5'),
    'Totalt efter Etapp 5' => array('*sumcomp*', 'Totalt efter Lunch', 'Etapp 5'),

    'Etapp 6' => array('R 6', 
      'P BCQ', 'TP 6', 'FP 6'),
    'Totalt efter Etapp 6' => array('*sumcomp*', 'Totalt efter Etapp 5', 'Etapp 6'),

    'Etapp 7' => array('R 7', 
      'P BJÖ', 
      'P CIR',  
      'TP 7', 'FP 7'),
    'Totalt efter Etapp 7' => array('*sumcomp*', 'Totalt efter Etapp 6', 'Etapp 7'),

    'Etapp 8' => array('R 8',
      'P BRI', 'TP 8', 'TP 9', 'FP 8', 'Tid M'),

    //'*picture*Prisutdelning:prisutdelning.jpg',

    '*picture*Rallyväg:rallyväg.jpg',

    // Stilpris
    '*picture*Stilpriset:Stilochfiness.jpg',
    //'*picture*1 till 2 till:stil.jpg',
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
    '*picture*Pysselpriset:Pysselpris.jpg',
    'Pyssel totalt' =>
    array('*sum*',
      'P MUS',
      'P OAT',
      'P GAM',
      'P TRA',
      'P FIS',
      'P LIM',
      'P BIL',
      'P FIE',
      'P BCQ',
      'P BJÖ',
      'P CIR',
      'P BRI',
      'P VAL',
      'P MJÖ'),

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
    '*picture*Backpriset:Backpris.jpg',
    '*picture*Läggarpinnen:pinne.jpg',
    'Läggarpinnen' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8', 'Stil'),
    '*picture*Sura trean:SuraTrean.jpg',
    );

$maxPoints =
  array(
    'P MUS' => 28, # 28 frågor
    'P OAT' => 15, # 15 frågor
    'P GAM' => 21, # 21 frågor
    'P TRA' => 20, # 40 frågor
    'P FIS' => 18, # 36 låtar, 36 artister
    'P LIM' => 0, # -20 -> 0
    'P BIL' => 24, # 12 grupper
    'P FIE' => 24, # 24 f i e p
    'P BCQ' => 24, # 6*4 frågor
    'P BJÖ' => 24, # 12 djur, 12 latin
    'P CIR' => 32, # 32 frågor
    'P BRI' => 18, # 9 låtar, 9 artister
    'P VAL' => 13, # 13 frågor
    'P MJÖ' => 16, # 16 påsar
  );

$info =
  array(
        'P MUS' => '<red>1 per fel',
        'P OAT' => '<red>1 per fel',
        'P GAM' => '<red>0.5 per gen, 0.5 per sak, avrunda till fler prickar',
        'P TRA' => '<red>0.5 per fel, avrunda till fler prickar',
        'P FIS' => '<red>0.25 per fel, avrunda till fler prickar',
        'P LIM' => '<red>-5 om godkänt. -10,-15,-20 för de bästa',
        'P BIL' => '<red>2 per fel',
        'P FIE' => '<red>1 per fel',
        'P BCQ' => '<red>1 per fel',
        'P BJÖ' => '<red>1 per fel',
        'P CIR' => '<red>1 per fel',
        'P BRI' => '<red>1 per fel',
        'P VAL' => '<red>1 per fel',
        'P MJÖ' => '<red>1 per fel',

        'P .*' => '1 per fel',
        'ÖppReb' => '5 gånger antalet icke-blåbär',
        'ÖppPlk' => '100',
        'StjPlk' => '-10 per bild',
        'Tid S' => '1 per minut',
        'Tid L' => '1 per minut',
        'Tid M' => '1 per minut, 2 efter 17:30',
        'R [0-9]+' => '25 klippt hjälp, 45 klippt nöd',
        'S [0-9]+' => '-10 korrekt motiverad lösning',
        'FP [0-9]+' => '10 missat plock, 20 felaktigt plock',
        'TP 9' => '-5 per korrekt tema',
        'TP [0-9]+' => '5 missat plock, 10 felaktigt falskt plock'
        );
?>
