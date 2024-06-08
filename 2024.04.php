<?php
//TODO: fixa loggan
require_once 'slide.php';

$teams = array(
    // Name => (number, number of members, flair)
    // Available flairs: <small>, <blue>, <smallblue>, <free>, <legends>
    'Viktat Projektivt Rum'        => array(1, 6),
    'Enar Åkered'                  => array(2, 8, '<free>'),
    'RRL för Claes Elfsberg'       => array(3, 8, '<free>'),
    'Ibsens Kusiner'               => array(4, 8),
    'Senaste Laget'                => array(5, 8),
    'Tegalreden'                   => array(6, 3),
    'Så att säga'                  => array(7, 3, '<small>'),
    'Battes Barlast'               => array(8, 11, '<small>'),
    'Katlas Kompisar'              => array(9, 9, '<free>'),
    'Öset Luhring'                 => array(10, 8, '<legends>'),
    'Sötgötarna'                   => array(11, 7),
    'Ingenjörer på gränsen'        => array(42, 8),
    'Trial & Error'                => array(88, 9),
    'Blodbussen'                   => array(112, 1)
);

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

    'ÖppPlk' => 'Öppnat stjälpfotoplockkuvertet',
    'StjPlk' => 'Redovisade stjälpfotoplock',

    'ÖppTlk' => 'Öppnat stjälptallriksplockkuvertet',
    'StjTlk' => 'Redovisade stjälptallriksplock',

    // Pyssel förmiddag
    'P APR' => 'Pyssel 1: April, april!',
    'P DEF' => 'Pyssel 2: DEFinitioner',
    'P SKO' => 'Pyssel 3: Hålligång i skogen',
    'P ORD' => 'Pyssel 4: Ordfläta',
    'P SÖK' => 'Pyssel 5: Söker dig!',
    'P VAD' => 'Pyssel 6: Vad ska bort?',
    'P SYS' => 'Pyssel 7: Vad sysslar dina föräldrar egentligen med?',
    'P MUS' => 'Pyssel 8: Melodikrysset',


    // Heldagspyssel
    'P KLI' => 'Pyssel 9: Det sade bara klick!',
    'P HAK' => 'Pyssel 10: Hakuna matata',
    'P STA' => 'Pyssel 11: Jättestark eller jättestark',
    'P LAG' => 'Pyssel 12: Lagar och straff',
    'P MAT' => 'Pyssel 13: Mattepyssel',
    'P SUN' => 'Pyssel 14: Sunda vätskor',
    'P SYN' => 'Pyssel 15: Synonymer',

    // Lunchpyssel
    'P NÖR' => 'Lunchpyssel 1: Tipspromenad - Nördkunskap',
    'P BÖN' => 'Lunchpyssel 2: Bönrörigt',
    'P DÖR' => 'Lunchpyssel 3: Lämna inga dörrar på glänt!',

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

# TODO: Har detta kvar att fylla i, samt bilder och färger
$parts = array(
    '*picture*Rebusrally April 2024:rally-2024-title-card.png',

    // Om du vill ha en bild som representerar Etapp #n så kan du bara spara en bild
    // med namn 'etapp1.jpg' eller 'etapp4.png' i din resultatmapp så kommer den 
    // automagiskt att bli visad.
    '*picture*Rallykarta VT2024:karta.jpg',

    'Etapp 1' => array('Tid S', 'R 1', 'P APR', 'P DEF', 'TP 1', 'FP 1'),

    'Etapp 2' => array('R 2', 'P SKO', 'P ORD', 'TP 2', 'FP 2'),
    'Totalt efter Etapp 2' => array('*sumcomp*', 'Etapp 1', 'Etapp 2'),

    'Etapp 3' => array('R 3', 'P SÖK', 'P VAD', 'TP 3', 'FP 3'),
    'Totalt efter Etapp 3' => array('*sumcomp*', 'Totalt efter Etapp 2', 'Etapp 3'),

    // '*picture*Etapp 4 - Med Melodikrysset:Musikkryss.png',
    'Etapp 4 - Med Melodikrysset' => array(
        '*picture*Var är stjälptallriken?:sexa_a.jpg',
        '*picture*VAR är stjälptallriken?:sexa_b.jpg',
        '*picture*DÄR är stjälptallriken!:sexa_c.jpg',
        'R 4','P SYS', 'P MUS', 'TP 4', 'FP 4', 'Tid L'),
    'Totalt efter Etapp 4' => array('*sumcomp*', 'Totalt efter Etapp 3', 'Etapp 4 - Med Melodikrysset'),

    'Lunch' =>
    array(
        'P NÖR',
        'P BÖN',
        'P DÖR',
        '*picture*Stjälpfotoplock:stjälp2.png',
        'ÖppPlk',
        'StjPlk',
        '*picture*Stjälptallriksplock:stjälptallrik.png',
        'ÖppTlk',
        'StjTlk',
        array('*esum*', 'Stjälpplock totalt', 'ÖppPlk', 'StjPlk', 'ÖppTlk', 'StjTlk'),
        // Redovisning stjälpplock
        'ÖppReb',
        'S 1', 'S 2', 'S 3', 'S 4', 'S 5', 'S 6', 'S 7',
        'S 8', 'S 9', 'S 10', 'S 11', 'S 12',
        // Summering av stjälprebusar
        array('*esum*', 'Stjälprebusar totalt',
              'ÖppReb',
              'S 1', 'S 2', 'S 3', 'S 4', 'S 5',
              'S 6', 'S 7', 'S 8', 'S 9', 'S 10', 
              'S 11', 'S 12'
        ),
    ),
    'Totalt efter Lunch' => array('*sumcomp*', 'Totalt efter Etapp 4', 'Lunch'),

    'Etapp 5' => array('R 5', 'P KLI', 'P HAK', 'TP 5', 'FP 5'),
    'Totalt efter Etapp 5' => array('*sumcomp*', 'Totalt efter Lunch', 'Etapp 5'),

    'Etapp 6' => array('R 6', 'P STA', 'P LAG', 'TP 6', 'FP 6'),
    'Totalt efter Etapp 6' => array('*sumcomp*', 'Totalt efter Etapp 5', 'Etapp 6'),

    'Etapp 7' => array('R 7', 'P MAT', 'P SUN', 'TP 7', 'FP 7'),
    'Totalt efter Etapp 7' => array('*sumcomp*', 'Totalt efter Etapp 6', 'Etapp 7'),

    'Etapp 8' => array('R 8', 'P SYN', 'TP 8', 'FP 8', 'Tid M'),

    // PRISUTDELNINGAR
    '*picture*Prisutdelning:nobel.jpg',

    // Stilpris
    '*picture*Stilpriset:stylish.png',
    '*sorted*Stil',
    '*picture*Trial & Error:födelsedag.jpg',

    // Plockpris
    '*picture*Bästa plockare:plock.jpg',
    'Plock totalt' =>
    array('*sum*',
          'TP 1', 'TP 2', 'TP 3', 'TP 4', 'TP 5', 'TP 6', 'TP 7', 'TP 8',
          'FP 1', 'FP 2', 'FP 3', 'FP 4', 'FP 5', 'FP 6', 'FP 7', 'FP 8',
          'ÖppPlk', 'StjPlk', 'ÖppTlk', 'StjTlk'),

    // Pysselpriset
    '*picture*Pysselpriset:pyssel.jpg',
    'Pyssel totalt' =>
    array('*sum*',
    'P APR', 'P DEF', 'P SKO', 'P ORD', 'P SÖK', 'P VAD', 'P SYS', 'P MUS',
    'P KLI', 'P HAK', 'P STA', 'P LAG', 'P MAT', 'P SUN', 'P SYN', 'P NÖR',
    'P BÖN', 'P DÖR'),

    // Rebuspriset
    '*picture*Rebuspriset:a-dur.png',
    'Rebusar totalt' =>
    array('*sum*',
          'ÖppReb', 'S 1', 'S 2', 'S 3', 'S 4',
          'S 5', 'S 6', 'S 7', 'S 8', 'S 9', 'S 10', 'S 11', 'S 12',
          'R 1', 'R 2', 'R 3', 'R 4',
          'R 5', 'R 6', 'R 7', 'R 8'),

    '*picture*Och vinnaren är...:resultat.png',
    'Slutresultat' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8', 'Stil'),
    'Ständiga tvåan' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8', 'Stil'),
    //'Blåbärspriset' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8', 'Stil'),
    'Bästa småbil' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8', 'Stil'),
    'Bästa utlänska lag' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8', 'Stil'),
    'Mittenpriset' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8', 'Stil'),
    //'Sura trean' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8', 'Stil'),
    '*picture*Grattis Blodbussen!:trophy.jpg',
    );

// TODO: Dessa är mestadels i ordning, men behöver ses över igen.
$maxPoints = array(
    'P APR' => 23,
    'P DEF' => 22,
    'P SKO' => 12,
    'P MUS' => 39,
    'P ORD' => 24,
    'P SÖK' => 19,
    'P VAD' => 20,
    'P SYS' => 16,
    'P KLI' => 15,
    'P HAK' => 12,
    'P STA' => 17,
    'P LAG' => 10,
    'P MAT' => 24,
    'P SUN' => 16,
    'P SYN' => 17,
    'P NÖR' => 12,
    'P BÖN' => 6,
    'P DÖR' => 18,
);

$info = array(
    'P APR' => '<red>1 per fel (frågor med fler än ett ord måste vara kompletta för att räknas som korrekt besvarade)',
    'P DEF' => '<red>1 per fel',
    'P SKO' => '<red>1 per fel',
    'P MUS' => '<red>1 per fel',
    'P ORD' => '<red>1 prick per bild som saknas i flätan, -5 prickar om man får med alla bilder',
    'P SÖK' => '<red>Upp till 1 prick per annons (summera alla fel och dela med 3, avrunda sedan nedåt)',
    'P VAD' => '<red>1 per fel',
    'P SYS' => '<red>1 per fel',
    'P KLI' => '<red>Upp till 5 prickar per bild för utebliven eller undermålig gestaltning',
    'P HAK' => '<red>1 per fel',
    'P STA' => '<red>1 per fel',
    'P LAG' => '<red>1 per fel',
    'P MAT' => '<red>2 för felaktigt svar, 1 för svar inom det större intervallet',
    'P SUN' => '<red>1 per fel',
    'P SYN' => '<red>0,5 per fel (avrundas nedåt)',
    'P NÖR' => '<red>1 per fel',
    'P BÖN' => '<red>1 per fel',
    'P DÖR' => '<red>1 per fel',
    'P .*' => '<red>1 prick per fel',
    
    'ÖppReb' => '40',
    'ÖppPlk' => '80',
    'ÖppTlk' => '30',
    'StjPlk' => '-10 per bild',
    'StjTlk' => '-5 per tallrik',
    
    'Tid S' => '1 per minut',
    'Tid L' => '1 per minut',
    'Tid M' => '1 per minut, 2 efter 17:30',

    'R [0-9]+' => '25 klippt hjälp, 45 klippt nöd',
    'S [0-9]+' => '-10 korrekt motiverad lösning',
    'FP [0-9]+' => '10 missat plock, 20 falskt plock',
    'TP [0-9]+' => '5 missat plock, 10 falskt plock'
);
?>
