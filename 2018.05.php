<?php

require_once 'slide.php';

$teams = array(
               // Name => (number, number of members, flair)
               // Available flairs: <small>, <blue>, <smallblue>
               'Så att Säga'            => array(1, 1, '<small>'),
               'Enar Åkered'            => array(2, 1),
               'RRL för Claes Elfsberg' => array(3, 1),
               'Webus Express'          => array(4, 1),
               'Ibsens kusiner'         => array(5, 1),
               '1 till 2 till'          => array(6, 1),
               'Katlas Kompisar'        => array(7, 1),
               'Risk för dåligt väglag' => array(15, 1),
               'Definitivt Goa Gubbar'  => array('031', 1, '<blue>'),
               'Öset Luhring'           => array(63, 1),
               'Blodbussen'             => array(112, 1, '<blue>'),
               'Senaste Laget'          => array(8, 1),
               'Sötgötarna'             => array(9, 1),
               'I blåbärsräjset finns ingen pyjamas' => array(10, 1, '<blue>'),
               'Suddens bergsmyntor'    => array(11, 1),
               'I minsta laget'         => array(12, 1, '<small>'),
               'Rattmuffarna'           => array(42, 1, '<small>'),
               );

// Blåbärsrebusar
$bluerebus = array(2, 3, 4, 6, 7, 8);

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

    'Lott' => 'Stjälplott',

    // Heldagspyssel

    // Förmiddagspyssel
    'P MUL' => 'Multiplikationstabellen',
    'P FEM' => 'Fem löser ett pyssel',
    'P BIL' => 'Gör din egen bildrebus',
    'P TOR' => 'Ord med TOR',
    'P EMO' => 'Emoji',

    // Lunchpyssel
    'P TVS' => 'TV-spelstipspromenad',
    'P MÄT' => 'Tungviktare',

    // Eftermiddagspyssel
    'P KAR' => 'Kartplock',
    'P ICO' => 'Ikoner',
    'P MUS' => 'Musikkryss',
    'P RIT' => 'Rita någonting fint',
    'P SHI' => 'Ordskiftet',
    'P OKW' => 'Lagpysslet',
    'P TET' => 'T&ETRIS',

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
    '*picture*Rebusrally 2018-05:trial-error.gif',
    '*picture*Start:start.jpg',

    'Etapp 1' => array('Tid S', 'P MUL', 'R 1', 'P FEM', 'TP 1', 'FP 1'),

    'Etapp 2' => array('R 2', 'P BIL', 'TP 2', 'FP 2'),
    'Totalt efter Etapp 2' => array('*sumcomp*', 'Etapp 1', 'Etapp 2'),

    'Etapp 3' => array('R 3', 'P TOR', 'TP 3', 'FP 3'),
    'Totalt efter Etapp 3' => array('*sumcomp*', 'Totalt efter Etapp 2', 'Etapp 3'),

    'Etapp 4' => array('R 4', 'P EMO', '*picture*Tallrik:tallrik.jpg', 'TP 4', 'FP 4', 'Tid L'),
    'Totalt efter Etapp 4' => array('*sumcomp*', 'Totalt efter Etapp 3', 'Etapp 4'),

    'Lunch' =>
    array(
          '*picture*Lunch:lunch.jpg',
          '*picture*Lunch:lunch_rebus.jpg',
          '*picture*Lunch:grill.jpg',
          'P MÄT',
          'P TVS',
          'ÖppPlk', 'StjPlk',
          array('*esum*', 'Stjälpplock totalt', 'StjPlk', 'ÖppPlk'),
          'Lott',
          'ÖppReb',
          'S 1', 'S 2', 'S 3', 'S 4', 'S 5', 'S 6', 'S 7',
          'S 8', 'S 9', 'S 10', 'S 11', 'S 12',
          //'*solution*S9Rattmuffarna',
          array('*esum*', 'Stjälprebusar totalt',
                'ÖppReb',
                'S 1', 'S 2', 'S 3', 'S 4', 'S 5',
                'S 6', 'S 7', 'S 8', 'S 9', 'S 10', 'S 11', 'S 12')),
    'Totalt efter Lunch' => array('*sumcomp*', 'Totalt efter Etapp 4', 'Lunch'),

    'Etapp 5' => array('R 5', 'P KAR',
          '*picture*Rita Webus Express:rita_lag4.jpg',
          '*picture*Rita Rattmuffarna:rita_lag42.jpg',
          '*picture*Rita Ibsens Kusinser:rita_lag5.jpg',
          'P RIT', 'TP 5', 'FP 5'),
    'Totalt efter Etapp 5' => array('*sumcomp*', 'Totalt efter Lunch', 'Etapp 5'),

    'Etapp 6' => array('R 6', 'P ICO', 'P OKW', 'TP 6', 'FP 6'),
    'Totalt efter Etapp 6' => array('*sumcomp*', 'Totalt efter Etapp 5', 'Etapp 6'),

    'Etapp 7' => array('R 7', 'P MUS', 'TP 7', 'FP 7'),
    'Totalt efter Etapp 7' => array('*sumcomp*', 'Totalt efter Etapp 6', 'Etapp 7'),

    'Etapp 8' => array('R 8', 'P SHI', 'P TET', 'TP 8', 'TP 9', 'FP 8', 'Tid M'),

    '*picture*Karta:karta.jpg',

    // Stilpris
    '*picture*Stilpriset:trophy.jpg',
    '*picture*1 till 2 till:stil.jpg',
    '*picture*Blodpåse:blod.jpg',
    '*sorted*Stil',

    // Plockpris
    '*picture*Bästa plockare:trophy.jpg',
    'Plock totalt' =>
    array('*sum*',
          'TP 1', 'TP 2', 'TP 3', 'TP 4', 'TP 5', 'TP 6', 'TP 7', 'TP 8',
          'TP 9',
          'FP 1', 'FP 2', 'FP 3', 'FP 4', 'FP 5', 'FP 6', 'FP 7', 'FP 8',
          'ÖppPlk', 'StjPlk'),

    // Pysselpriset
    '*picture*Pysselpriset:trophy.jpg',
    'Pyssel totalt' =>
    array('*sum*',
          'P MUL', 'P FEM', 'P BIL', 'P TOR', 'P EMO', 'P TVS',
          'P MÄT', 'P KAR', 'P ICO', 'P MUS', 'P RIT', 'P SHI',
          'P OKW', 'P TET'),

    // Rebuspriset
    '*picture*Rebuspriset:trophy.jpg',
    'Rebusar totalt' =>
    array('*sum*',
          'ÖppReb', 'S 1', 'S 2', 'S 3', 'S 4',
          'S 5', 'S 6', 'S 7', 'S 8', 'S 9', 'S 10', 'S 11', 'S 12',
          'R 1', 'R 2', 'R 3', 'R 4',
          'R 5', 'R 6', 'R 7', 'R 8'),
    '*picture*Blåbärsrebuspriset:trophy.jpg',

    '*picture*Förstapriset:trophy.jpg',
    'Totalt' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8', 'Stil'),
    // Blåbärspriset
    // Ständiga tvåan
    // Bästa småbil
    // Bästa utlänska lag
    // Mittenpriset
    // SaS kula på en pinne
    // Backpriset
    // Läggarpinnen
    // Sura trean

    //'*picture*XXXX:back.jpg'

    );

$maxPoints =
  array(
    'P MUL' => 24,
    'P FEM' => 28,
    'P BIL' => 21,
    'P TOR' => 26,
    'P EMO' => 19,
    'P TVS' => 13,
    'P MÄT' => 20,
    'P KAR' => 24,
    'P ICO' => 30,
    'P MUS' => 30,
    'P RIT' => 20,
    'P SHI' => 20,
    'P OKW' => 24,
    'P TET' => 25
  );

$info =
  array(
        'P RIT' => '<red>0 för kabanoss, 25 för dålig, bedömning från Janne',
        'P MÄT' => '<red>0 inom 5%, 1 om 5-15%, 2 annars',
        'P SHI' => '<red>2 per fel, -5 om sista rätt',
        'P MUL' => '<red>2 per fel',
        'P OKW' => '<red>2 per fel',
        'P KAR' => '<red>3 per fel',
        'P BIL' => '<red>3 per fel',
        'P FEM' => '<red>2 per fel',
        'P EMO' => '<red>1 per fel låt, 1 per fel artist (en saknar artist)',
        'P TET' => '<red>25 om ej löst',
        'P .*' => '1 per fel',
        'Lott' => '10 för öppnat kuvert',
        'ÖppReb' => '30',
        'ÖppPlk' => '40',
        'StjPlk' => '-5 per bild, -5 per rätt mur',
        'Tid S' => '1 per minut',
        'Tid L' => '1 per minut',
        'Tid M' => '1 per minut, 2 efter 17:30',
        'R [0-9]+' => '25 klippt hjälp, 45 klippt nöd, felaktiga kontrollbokstäver 25',
        'S [0-9]+' => '-10 korrekt motiverad lösning',
        'FP [0-9]+' => '10 missat plock, 20 falskt plock',
        'TP 9' => '-5 per korrekt tema',
        'TP [0-9]+' => '5 missat plock, 10 falskt plock'
        );
?>
