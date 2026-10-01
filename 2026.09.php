<?php

require_once 'slide.php';

$teams = array(
  // Name => (number, number of members, flair)
  // Available flairs: <small>, <blue>, <smallblue>, <free>, <legends>
  'Viktat Projektivt Rum'           => array(1, 9, '<small>'),
  'Re-Busarna'                      => array(1.618, 9, '<blue>'),
  'Enar Åkered'                     => array(2, 9),
  'Ibsens kusiner'                  => array(3, 9, '<free>'),
  'SICKet lag'                      => array(4, 6, '<blue>'),
  'RRL för Claes Elfsborg'          => array(5, 9, '<small>'),
  'Senaste Laget'                   => array(6, 8),
  'Katlas Kompisar'                 => array(7, 9, '<free>'),
  'Klätterkamraterna'               => array(8, 9, '<blue>'),
  'Sötgötarna'                      => array(11, 8, '<free>'),
  'Skalmans Självgående Skottkärra' => array(22, 9, '<small>'),
  'Så att säga'                     => array(24, 3),
  'Ingenjörer på gränsen'           => array(42, 9),
  'Buzzin\''                        => array(83, 9),
  'Trial & Error'                   => array(88, 9),
  'Blodbussen'                      => array(112, 9),
  'TBD'                             => array(780, 7)
); 
               
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
  'P LJU' => 'Ljud i köket',
  'P EBU' => 'Inte rEBUsar',
  'P PRP' => 'Pyssel, Rebus Pyssel',
  'P PÄR' => 'Pärlpysslet',
  'P PAT' => 'Patentverket',
  'P TRA' => 'Ordtransformation',
  'P SIN' => 'Singel & sökande',
  'P POJ' => 'Pojken som ropade kvarg',
  
  // Lunchpyssel
  'P TIP' => 'Tipspromenad',
  'P KAK' => 'Kakor',
  
  // Pyssel förmiddag
  'P MUS' => 'Musikkrysset',
  'P ÅSI' => 'Åsiktspysslet',
  'P ORD' => 'Ordfläta',
  'P IDR' => 'Idrottsgrenar',
  'P PRO' => 'Ett oproportionerligt proportionerligt pyssel',
  'P LAN' => 'Landssilhuetter',
  'P MIN' => 'Min bättre hälft',

  // Pyssel eftermiddag
  // <inga>

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
  '*picture*Rebusrally September 2026:bild_rally-ht-2026-title-card',
  '*picture*Enkätsvar:bild_Skadetblikulattåkarally',

  '*picture*Etapp 1:bild_sträcka1',

  'Etapp 1' => array('Tid S', 'R 1',
    '*picture*Musikkrysset:bild_Musikkryss', 'P MUS',
    '*picture*Åsiktspysslet:bild_Åsiktspysslet',
    '*picture*Åsiktspysslet:bild_åsikt1-4',
    '*picture*Åsiktspysslet:bild_åsikt5-10',
    '*picture*Åsiktspysslet:bild_åsikt11-14',
    'P ÅSI', 'TP 1', 'FP 1'),

  '*picture*Etapp 2:bild_BAS',

  'Etapp 2' => array('R 2',
    '*picture*Ordfläta:bild_Ordfläta', 'P ORD',
    '*picture*Idrottsgrenar:bild_Idrottsgrenar', 'P IDR', 'TP 2', 'FP 2'),
  'Totalt efter Etapp 2' => array('*sumcomp*', 'Etapp 1', 'Etapp 2'),

  '*picture*Etapp 3:bild_not',

  'Etapp 3' => array('R 3',
    '*picture*Ett oproportionerligt proportionerligt pyssel:bild_Proportionspyssel', 'P PRO',
    '*picture*Landssilhuetter:bild_Landssilhuetter', 'P LAN', 'TP 3', 'FP 3'),
  'Totalt efter Etapp 3' => array('*sumcomp*', 'Totalt efter Etapp 2', 'Etapp 3'),

  '*picture*Etapp 3 - UKU:bild_UKU1',
  '*picture*Etapp 3 - UKU:bild_UKU2',
  '*picture*Etapp 3 - UKU:bild_UKU3',

  '*picture*Etapp 4:bild_sträcka4',

  'Etapp 4' => array('R 4',
    '*picture*Min bättre hälft:bild_Dubbla personligheter', 'P MIN', 'TP 4', 'FP 4'),
  'Totalt efter Etapp 4' => array('*sumcomp*', 'Totalt efter Etapp 3', 'Etapp 4'),

  'Lunch' =>
  array(
      '*picture*Lunch:bild_Naturum',
      'Tid L',
      '*picture*Tipspromenad:bild_Tipspromenad',
      'P TIP',
      '*picture*Kakor:bild_kaka',
      'P KAK',
      '*picture* :bild_plock',
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
    '*picture*Ljud i köket:bild_stomp', 'P LJU',
    '*picture*Inte rEBUsar:bild_EBU', 'P EBU', 'TP 5', 'FP 5'),
  'Totalt efter Etapp 5' => array('*sumcomp*', 'Totalt efter Lunch', 'Etapp 5'),

  '*picture*Etapp 6:bild_sträcka6',

  'Etapp 6' => array('R 6',
    '*picture*Pyssel, Rebus Pyssel:bild_lechiffre', 'P PRP', 'P PÄR', 'TP 6', 'FP 6'),
  'Totalt efter Etapp 6' => array('*sumcomp*', 'Totalt efter Etapp 5', 'Etapp 6'),

  'Etapp 7' => array('R 7',
    '*picture*Patentverket:bild_PATENTVERKET', 'P PAT',
    '*picture*Ordtransformation:bild_in-ut', 'P TRA',  'TP 7', 'FP 7'),
  'Totalt efter Etapp 7' => array('*sumcomp*', 'Totalt efter Etapp 6', 'Etapp 7'),

  'Etapp 8' => array('R 8',
    '*picture*Singel & sökande:bild_Singelochsökande', 'P SIN',
    '*picture*Pojken som ropade kvarg:bild_POJKEN SOM ROPADE KVARG', 'P POJ', 'TP 8', 'FP 8', 'Tid M'),

  '*picture*Prisutdelning:bild_Prisutdelning',

  // Stilpris
  '*picture*Stil och finess:bild_Stilpriset',
  '*sorted*Stil',
  '*picture*Stil och finess:bild_sötgötarna',

  // Plockpris
  '*picture*Bästa plockare:bild_Plockpriset',
  'Plock totalt' =>
  array('*sum*',
        'TP 1', 'TP 2', 'TP 3', 'TP 4', 'TP 5', 'TP 6', 'TP 7', 'TP 8',
        'FP 1', 'FP 2', 'FP 3', 'FP 4', 'FP 5', 'FP 6', 'FP 7', 'FP 8',
        'ÖppPlk', 'StjPlk'),
  '*picture*Bästa blåbärsplockare:bild_Blåbärsplockpriset',
  'Plock totalt (Blåbärspris)' =>
  array('*sum*',
        'TP 1', 'TP 2', 'TP 3', 'TP 4', 'TP 5', 'TP 6', 'TP 7', 'TP 8',
        'FP 1', 'FP 2', 'FP 3', 'FP 4', 'FP 5', 'FP 6', 'FP 7', 'FP 8',
        'ÖppPlk', 'StjPlk'),

  // Pysselpriset
  '*picture*Pysselpriset:bild_Pysselpriset',
  'Pyssel totalt' =>
  array('*sum*',
  'P LJU',
  'P EBU',
  'P PRP',
  'P PÄR',
  'P PAT',
  'P TRA',
  'P SIN',
  'P POJ',
  'P TIP',
  'P KAK',
  'P MUS',
  'P ÅSI',
  'P ORD',
  'P IDR',
  'P PRO',
  'P LAN',
  'P MIN'),

  // Rebuspriset
  '*picture*Rebuspriset:bild_Rebuspriset',
  'Rebusar totalt' =>
  array('*sum*', 'ÖppReb', 'S 1', 'S 2', 'S 3', 'S 4',
        'S 5', 'S 6', 'S 7', 'S 8', 'S 9', 'S 10', 'S 11', 'S 12',
        'R 1', 'R 2', 'R 3', 'R 4',
        'R 5', 'R 6', 'R 7', 'R 8'),
  '*picture*Blåbärsrebuspriset:bild_Blåbärsrebuspriset',
  'Rebusar totalt (Blåbärspris)' =>
  array('*sum*', 'ÖppReb', 'S 1', 'S 2', 'S 3', 'S 4',
        'S 5', 'S 6', 'S 7', 'S 8', 'S 9', 'S 10', 'S 11', 'S 12',
        'R 1', 'R 2', 'R 3', 'R 4',
        'R 5', 'R 6', 'R 7', 'R 8'),

  '*picture*Färstapriset:bild_Färstapriset',
  'Totalt' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8', 'Stil'),
  '*picture*Ständiga tvåan:bild_Andrapriset',
  'Ständiga tvåan' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8', 'Stil'),
  '*picture*Blåbärspriset:bild_Blåbärspriset',
  'Blåbärspriset' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8', 'Stil'),
  '*picture*Bästa småbil:bild_Småbilspriset',
  'Bästa småbil' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8', 'Stil'),
  '*picture*Bästa utlänska lag:bild_Bästa utlänska lag',
  'Bästa utlänska lag' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8', 'Stil'),
  '*picture*Mittenpriset:bild_Mittenpriset',
  'Mittenpriset' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8', 'Stil'),
  '*picture*Backpriset:bild_Backpriset',
  '*picture*Läggarpinnen:bild_Läggarpinnen',
  'Läggarpinnen' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8', 'Stil'),
  '*picture*Sura trean:bild_Sura Trean',
  '*picture*Tack för oss!:bild_slut'
);

$maxPoints = array(
  'P LJU' => 14,
  'P EBU' => 15,
  'P PRP' => 12,
  'P PÄR' => 24,
  'P PAT' => 10,
  'P TRA' => 24,
  'P SIN' => 13,
  'P POJ' => 20,
  'P TIP' => 13,
  'P KAK' => 10,
  'P MUS' => 32,
  'P ÅSI' => 16,
  'P ORD' => 28,
  'P IDR' => 12,
  'P PRO' => 20,
  'P LAN' => 20,
  'P MIN' => 26,
);

$info =  array(
  'P LJU' => '<red>1 per fel',
  'P EBU' => '<red>0.5 per fel, avrunda uppåt till hela prickar',
  'P PRP' => '<red>1 per fel',
  'P PÄR' => '<red>24 prickar -2 per pärla i den färg man lämnat in mest av, ner till 0',
  'P PAT' => '<red>0.5 per fel, avrunda uppåt till hela prickar',
  'P TRA' => '<red>2 per fel',
  'P SIN' => '<red>0.5 per fel, avrunda uppåt till hela prickar',
  'P POJ' => '<red>1 per fel',
  'P TIP' => '<red>1 per fel',
  'P KAK' => '<red>1 per fel',
  'P MUS' => '<red>1 per fel',
  'P ÅSI' => '<red>1 per fel',
  'P ORD' => '<red>1 per fel',
  'P IDR' => '<red>0.5 per fel, avrunda uppåt till hela prickar',
  'P PRO' => '<red>1 per fel',
  'P LAN' => '<red>1 per fel',
  'P MIN' => '<red>0.5 per fel, avrunda uppåt till hela prickar',

  'P .*' => '1 per fel',
  'ÖppReb' => '20 prickar för småbil, 30 för buss',
  'ÖppPlk' => '80',
  'StjPlk' => '-10 per bild',
  'Tid S' => '1 per minut',
  'Tid L' => '1 per minut efter 12:00, max 120',
  'Tid M' => '1 per minut efter 17:00, 2 efter 17:30, 4 efter 18:00',
  'R [0-9]+' => '25 klippt hjälp, 45 klippt nöd',
  'S [0-9]+' => '-10 korrekt motiverad lösning',
  'FP [0-9]+' => '10 per missat plock, 20 per felaktigt plock',
  'TP [0-9]+' => '5 per missat plock, 10 per felaktigt plock (falska plock är felaktiga)'
);

?>
