<?php

require_once 'slide.php';

$teams = array(
               // Name => (number, number of members, flair)
               // Available flairs: <small>, <blue>, <smallblue>, <free>, <legends>
               'Rattmuffarna'                 => array('0', 7),
               'Viktat Projektivt Rum'        => array(1, 7),
               'Ibsens Kusiner'               => array(2, 9),
               'RRL för Claes Elfsberg'       => array(3, 9,'<free>'),
               'Fjärde gången gillt'          => array(4, 8),
               'Senaste Laget'                => array(5, 8),
               'Ej i trafik'                  => array(6, 8),
               'Webus Express'                => array(7, 9),
               'Rebussen'                     => array(8, 6),
               'Tegalreden'                   => array(9, 5,'<small>'),
               'Öset Luhring'                 => array(10, 6,'<legends>'),
               'Katlas Kompisar'              => array(11, 9,'<free>'),
               'Sötgötarna'                   => array(12, 5,'<small>'),
               'StaBilen'                     => array(13, 7),
               'Risk för dåligt väglag'       => array(15, 8),
               'Så att säga'                  => array(27, 2,'<small>'),
               'Ingenjörer på gränsen'        => array(42, 8,'<blue>'),
               'Trial & Error'                => array(88, 9,'<free>'),
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

    // Bonusrebusar (ska heta X) Dödspysselrebusar
    // De här är egentligen inte med i resultaträkningen men jag kan inte ta bort dem
    // för de har en index-plats i databasen. Om de raderas så förskjuts alla andra inmatade
    // uppgifter och det blir massor av jobb. Suck.
    //
    // Tips för framtiden - tänk igenom presentationen innan du börjar fylla på databasen. :)
    'Y 1'    => 'Dödsrebus 1',
    'Y 2'    => 'Dödsrebus 2',
    'Y 3'    => 'Dödsrebus 3',
    'Y 4'    => 'Dödsrebus 4',
    'Y 5'    => 'Dödsrebus 5',
    'Y 6'    => 'Dödsrebus 6',
    'Y 7'    => 'Dödsrebus 7',
    'Y 8'    => 'Dödsrebus 8',
    'ÖppDöd' => 'Enars dödsrebuspyssel',


    'ÖppPlk' => 'Öppnat stjälpfotoplockkuvertet',
    'StjPlk' => 'Stjälpfotoplock totalt',

    // Pyssel förmiddag
    'P FRÖ' => 'Pyssel 1: Känn igen frön',
    'P VEM' => 'Pyssel 2: Hallå vem är det?',
    'P CAT' => "Pyssel 3: It's raining katter och hundar",
    'P MUS' => 'Pyssel 4: Melodikrysset',

    // Heldagspyssel
    'P SIG' => 'Pyssel 5: Signifikanta Signaler',
    'P ZEB' => 'Pyssel 6: Vem äger Zebran',
    'P CIT' => 'Pyssel 7: Sätter du citatet?',
    'P SLB' => 'Pyssel 8: Slackbang',
    'P SPO' => 'Pyssel 9: Sportsiffror',
    'P PAR' => 'Pyssel 10: Par i manga',
    'P ABS' => 'Pyssel 11: Absurda små krig',

    // Lunchpyssel
    'P 1X2' => 'Lunchpyssel: Tipspromenad',

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
    // 'TEMA' => 'Tallrikstema',

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
    '*picture*Rebusrally September 2023:Enar-logo_1.png',

    // Future reference:
    // Om du vill ha en bild som representerar Etapp #n så kan du bara spara en bild
    // med namn 'etapp1.jpg' eller 'etapp4.png' i din resultatmapp så kommer den 
    // automagiskt att bli visad.

    // Jag vill ha en egen text så jag gör det manuellt.
    '*picture*Etapp 1 - utan allt som är förbjudet:AlltÄrFörbjudet.jpg',
    'Etapp 1' => array('Tid S', 'R 1', 'P FRÖ', 'TP 1', 'FP 1'),

    '*picture*Etapp 2:bil1.png',
    'Etapp 2' => array('R 2', 'P VEM', 'TP 2', 'FP 2'),
    'Totalt efter Etapp 2' => array('*sumcomp*', 'Etapp 1', 'Etapp 2'),

    '*picture*Etapp 3:minibuss.jpeg',
    'Etapp 3' => array('R 3', 'P CAT', 'TP 3', 'FP 3'),
    'Totalt efter Etapp 3' => array('*sumcomp*', 'Totalt efter Etapp 2', 'Etapp 3'),

    '*picture*Etapp 4 - Med Melodikrysset:Musikkryss.jpg',
    'Etapp 4' => array('R 4', 'P MUS', 'ÖppDöd', 'TP 4', 'FP 4', 'Tid L'),
    'Totalt efter Etapp 4' => array('*sumcomp*', 'Totalt efter Etapp 3', 'Etapp 4'),

    '*picture*Pausmusik till lunchen:rickroll.png',
    'Lunch' =>
    array(
          //'*picture*Lunch:lunch.jpg',
        'P 1X2',
        'ÖppPlk',
        'StjPlk',
        array('*esum*', 'Stjälpplock totalt', 'StjPlk'),
        // Redovisning
        'ÖppReb',
        'S 1', 'S 2', 'S 3', 'S 4', 'S 5', 'S 6', '*solution*S6 viktat', 'S 7',
        'S 8', 'S 9', 'S 10', 'S 11', 'S 12',
        // Summering av Stjälpar
        array('*esum*', 'Stjälprebusar totalt',
              'ÖppReb',
              'S 1', 'S 2', 'S 3', 'S 4', 'S 5',
              'S 6', 'S 7', 'S 8', 'S 9', 'S 10', 
              'S 11', 'S 12'
        ),
        // Redovisning av Ytterligare rebusar (utom tävlan)
        'Y 1', 'Y 2', 'Y 3', 'Y 4',
        'Y 5', 'Y 6', 'Y 7', 'Y 8',
        // Summering av ytterligare rebusar (allt sammanslaget i ÖppDöd)
        array('*esum*', 'Enars Dödsrebuspyssel', 'ÖppDöd'),
    ),
    'Totalt efter Lunch' => array('*sumcomp*', 'Totalt efter Etapp 4', 'Lunch'),

    'Etapp 5' => array('R 5', 'P SIG', 'P ZEB', 'TP 5', 'FP 5'),
    'Totalt efter Etapp 5' => array('*sumcomp*', 'Totalt efter Lunch', 'Etapp 5'),

    'Etapp 6' => array('R 6', 'P CIT', 'P SLB', 'TP 6', 'FP 6'),
    'Totalt efter Etapp 6' => array('*sumcomp*', 'Totalt efter Etapp 5', 'Etapp 6'),

    'Etapp 7' => array('R 7', 'P SPO', 'P PAR', 'TP 7', 'FP 7'),
    'Totalt efter Etapp 7' => array('*sumcomp*', 'Totalt efter Etapp 6', 'Etapp 7'),

    '*picture*Etapp 8 - med Bisarra små krig:Krig.jpg',
    'Etapp 8' => array('R 8', 'P ABS', 'TP 8', 'FP 8', 'Tid M'),


    '*picture*Rallykarta HT2023:Rallykarta 1.0.png',

    // PRISUTDELNINGAR
    '*picture*Prisutdelning:throneroom.png',

    // Stilpris
    '*picture*RRL:tallrikskakor.jpg',
    '*picture*Webus:minirally.jpg',
    '*picture*Ibsen:krysskaka.jpg',
    '*picture*Katla:Kakkryss.jpg',
    
    '*sorted*Stil',

    // Plockpris
    // '*picture*Bästa plockare:plockpris.jpg',
    'Plock totalt' =>
    array('*sum*',
          'TP 1', 'TP 2', 'TP 3', 'TP 4', 'TP 5', 'TP 6', 'TP 7', 'TP 8',
          'FP 1', 'FP 2', 'FP 3', 'FP 4', 'FP 5', 'FP 6', 'FP 7', 'FP 8',
          'ÖppPlk', 'StjPlk'),

    // Pysselpriset
    // '*picture*Pysselpriset:pysselpris.jpg',
    'Pyssel totalt' =>
    array('*sum*',
    'P FRÖ', 'P VEM', 'P CAT', 'P MUS', 'P SIG', 'P ZEB', 'P CIT', 'P SLB',
    'P SPO', 'P PAR', 'P ABS', 'P 1X2'),

    // Rebuspriset
    // '*picture*Rebuspriset:rebuspris.jpg',
    'Rebusar totalt' =>
    array('*sum*',
          'ÖppReb', 'S 1', 'S 2', 'S 3', 'S 4',
          'S 5', 'S 6', 'S 7', 'S 8', 'S 9', 'S 10', 'S 11', 'S 12',
          'R 1', 'R 2', 'R 3', 'R 4',
          'R 5', 'R 6', 'R 7', 'R 8',
          'ÖppDöd'),
    // '*picture*Blåbärsrebuspriset:blåbärsrebus.jpg',
    // 'Rebusar totalt (Blåbärspris)' =>
    // array('*sum*','ÖppReb', 'S 1', 'S 2', 'S 3', 'S 4',
    //       'S 5', 'S 6', 'S 7', 'S 8', 'S 9', 'S 10', 'S 11', 'S 12',
    //       'R 1', 'R 2', 'R 3', 'R 4',
    //       'R 5', 'R 6', 'R 7', 'R 8',
    //       'ÖppDöd'),

    '*picture*Bonusrebus - en rovfågel på torrt gräs - Högladan:Högladan.jpg',
    // '*picture*Dags för Prisutdelningar!:throneroom.png',
    'Slutresultat' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8', 'Stil'),
    // 'Ständiga tvåan' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8', 'Stil'),
    //'Blåbärspriset' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8', 'Stil'),
    //'Bästa småbil' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8', 'Stil'),
    //'Bästa utlänska lag' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8', 'Stil'),
    //'Mittenpriset' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8', 'Stil'),
    //'Sura trean' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8', 'Stil'),
    '*picture*Grattis Webus Express:trophy.jpg',
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
        'ÖppDöd' => '5 per delt',
        'StjPlk' => '-10 per bild',
        'Tid S' => '1 per minut',
        'Tid L' => '1 per minut',
        'Tid M' => '1 per minut, 2 efter 18:00',
        'R [0-9]+' => '25 klippt hjälp, 45 klippt nöd',
        'S [0-9]+' => '-10 korrekt motiverad lösning',
        'FP [0-9]+' => '10 missat plock, 20 falskt plock',
        'TP 9' => '-5 per korrekt tema',
        'TP [0-9]+' => '5 missat plock, 10 falskt plock'
        );
?>
