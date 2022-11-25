<?php

require_once 'slide.php';

$teams = array(
               // Name => (number, number of members, flair)
               // Available flairs: <small>, <blue>, <smallblue>
               'The big five'                      => array(1, 5),
               'Pejst och kattungarna'             => array(2, 5),
               'Rattmuffarna'                      => array(3, 5),
               'Knial & Error'                     => array(4, 5),
               'Wargen'                            => array(5, 5),
               'Rebussen går vidare'               => array(6, 5),
               'Ture Femton'                       => array(7, 5),
               'Fem löser en rebus'                => array(8, 5),
               'Team Katla'                        => array(9, 5),
               'Team Kompisar'                     => array(10, 5),
               'Knubbsälarna'                      => array(11, 5),
               'Viktat Projektivt Rum'             => array(12, 5),
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

    // Bonus
    'X 1' => 'Bonus 1',
    'X 2' => 'Bonus 2',
    'X 3' => 'Bonus 3',
    'X 4' => 'Bonus 4',
    'X 5' => 'Bonus 5',
    // 'ÖppReb' => 'Öppnat stjälprebuskuvertet', // inga stjälp

    // inga stjälpplock
//     'ÖppPlk' => 'Öppnat stjälpplockkuvertet',
//     'StjPlk' => 'Stjälpplock',

    // Heldagspyssel
    'P MUS' => 'Das Musikkryss',
    'P GIB' => 'Gasen i botten, Tony Montana!',
    'P MEL' => 'Mel-pysslet',
    'P TAV' => 'Monet eller Manet?',
    'P TVÄ' => 'Tvärsnittspyssel',
    'P VPK' => 'Var på kartan',

    // Lunchpyssel
//     'P SMA' => 'Smakprov - vitt klägg',
//     'P BID' => 'Tipzpromenad',

    // Pyssel heldag
//     'P HEM' => 'Kommer du för att hämta mig',
//     'P HEV' => 'Kommer du för att hämta mig - Video',
//     'P KRY' => 'Kryptiskt korsord',
//     'P MEG' => 'Megasudoku',
//     'P SEK' => 'Sekvenser',
//     'P SVE' => 'Svengelska',
//     'P KED' => 'tanKedjan',

    'Stil' => 'Stil och finess',

    'Tid S' => 'Tidsprickar vid Start',
//     'Tid L' => 'Tidsprickar vid Lunch',
    'Tid M' => 'Tidsprickar vid Mål',

//     'TP MDF' => 'Fläskspotting',
//     'TP 1' => 'Tallriksplock 1',
//     'TP 2' => 'Tallriksplock 2',
//     'TP 3' => 'Tallriksplock 3',
//     'TP 4' => 'Tallriksplock 4',
//     'TP 5' => 'Tallriksplock 5',
//     'TP 6' => 'Tallriksplock 6',
//     'TP 7' => 'Tallriksplock 7',
//     'TP 8' => 'Tallriksplock 8',
//     'TP 9' => 'Tallrikstema',

      // 6 rebusar - 6 fotoplock?
    'FP 1' => 'Fotoplock 1',
    'FP 2' => 'Fotoplock 2',
    'FP 3' => 'Fotoplock 3',
    'FP 4' => 'Fotoplock 4',
    'FP 5' => 'Fotoplock 5',
    'FP 6' => 'Fotoplock 6',
//     'FP 7' => 'Fotoplock 7',
//     'FP 8' => 'Fotoplock 8'
    );

$parts = array(
    // '*picture*Rebusrally 2022-05:trial-error.gif',
    '*picture*Start:firstpage.jpg',

    'Etapp 1' => array('Tid S', 'R 1', 'P GIB', 'FP 1', 'X 1'),

    'Etapp 2' => array('R 2', 'P MEL', 'FP 2', 'X 2'),
    'Totalt efter Etapp 2' => array('*sumcomp*', 'Etapp 1', 'Etapp 2'),

    'Etapp 3' => array('R 3', 'P MUS', 'FP 3', 'X 3'),
    'Totalt efter Etapp 3' => array('*sumcomp*', 'Totalt efter Etapp 2', 'Etapp 3'),

    'Etapp 4' => array('R 4', 'P TAV', 'FP 4', 'X 4'),
    'Totalt efter Etapp 4' => array('*sumcomp*', 'Totalt efter Etapp 3', 'Etapp 4'),

//     'Lunch' =>
//     array(
//           //'*picture*Lunch:lunch.jpg',
// 	  'P SMA',
// 	  'P BID',
//           'ÖppPlk', 'StjPlk',
//           array('*esum*', 'Stjälpplock totalt', 'StjPlk', 'ÖppPlk'),
//           'ÖppReb',
//           'S 1', 'S 2', 'S 3', 'S 4', 'S 5', 'S 6', 'S 7',
//           'S 8', 'S 9', 'S 10', 'S 11', 'S 12',
//           array('*esum*', 'Stjälprebusar totalt',
//                 'ÖppReb',
//                 'S 1', 'S 2', 'S 3', 'S 4', 'S 5',
//                 'S 6', 'S 7', 'S 8', 'S 9', 'S 10', 'S 11', 'S 12')),
//     'Totalt efter Lunch' => array('*sumcomp*', 'Totalt efter Etapp 4', 'Lunch'),

    'Etapp 5' => array('R 5', 'P TVÄ', 'FP 5', 'X 5'),
    'Totalt efter Etapp 5' => array('*sumcomp*', 'Totalt efter Etapp 4', 'Etapp 5'),

    'Etapp 6' => array('R 6', 'P VPK', 'FP 6', 'Tid M'),
//     'Totalt efter Etapp 6' => array('*sumcomp*', 'Totalt efter Etapp 5', 'Etapp 6'),

//     'Etapp 7' => array('R 7', 'P SVE', 'TP MDF', 'TP 7', 'FP 7'),
//     'Totalt efter Etapp 7' => array('*sumcomp*', 'Totalt efter Etapp 6', 'Etapp 7'),

//     'Etapp 8' => array('R 8', 'P KED', 'TP 8', 'TP 9', 'FP 8', 'Tid M'),

    '*picture*Prisutdelning:lurar.jpg',

    //'*picture*Karta:karta.jpg',

    // Separat redovisning av stil, men inget pris?
    '*picture*Stilpriset:Stilpris.jpg',
    '*sorted*Stil',

    // Inget Plockpris
//     '*picture*Bästa plockare:plockpriset.png',
//     'Plock totalt' =>
//     array('*sum*',
//           'TP 1', 'TP 2', 'TP 3', 'TP 4', 'TP 5', 'TP 6', 'TP 7', 'TP 8',
//           'TP 9',
//           'FP 1', 'FP 2', 'FP 3', 'FP 4', 'FP 5', 'FP 6', 'FP 7', 'FP 8',
// 	  'TP MDF',
//           'ÖppPlk', 'StjPlk'),

    // Pysselpris?
//     '*picture*Pysselpriset:pysselpriset.png',
//     'Pyssel totalt' =>
//     array('*sum*',
//           'P MUS', 'P ÖÖL', 'P FRS', 'P DRD', 'P DUM', 'P ENG',
//           'P DÖD', 'P SMA', 'P BID', 'P HEM', 'P HEV', 'P KRY',
//           'P MEG', 'P SEK', 'P SVE', 'P KED'),

    // Rebuspris?
//     '*picture*Rebuspriset:trophy.jpg',
//     'Rebusar totalt' =>
//     array('*sum*',
//           'ÖppReb', 'S 1', 'S 2', 'S 3', 'S 4',
//           'S 5', 'S 6', 'S 7', 'S 8', 'S 9', 'S 10', 'S 11', 'S 12',
//           'R 1', 'R 2', 'R 3', 'R 4',
//           'R 5', 'R 6', 'R 7', 'R 8'),
//     '*picture*Blåbärsrebuspriset:trophy.jpg',

    '*picture*Förstapriset:trophy.jpg',
    'Totalt' => array('*sum*', 'Totalt efter Etapp 5', 'Etapp 6', 'Stil'),
//     '*picture*Ständiga tvåan:trophy.jpg',
//     'Ständiga tvåan' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8', 'Stil'),
//     '*picture*Blåbärspriset:trophy.jpg',
//     'Blåbärspriset' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8', 'Stil'),
//     '*picture*Bästa småbil:trophy.jpg',
//     'Bästa småbil' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8', 'Stil'),
//     '*picture*Bästa utlänska lag:trophy.jpg',
//     'Bästa utlänska lag' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8', 'Stil'),
//     '*picture*Mittenpriset:mittenpriset.png',
//     'Mittenpriset' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8', 'Stil'),
//     '*picture*Sura trean:trophy.jpg',
//     'Sura trean' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8', 'Stil'),
//     '*picture*SaS kula på en pinne:trophy.jpg',
//     '*picture*Backpriset:trophy.jpg',
    //'*picture*XXXX:back.jpg'
//     '*picture*Läggarpinnen:trophy.jpg'
    );

$maxPoints =
  array(
    'P MUS' => 25, # 17 frågor
    'P GIB' => 12, # 12 frågor
    'P MEL' => 31, # 31 frågor
    'P TAV' => 14, # 14*3 frågor
    'P TVÄ' => 21, # 16 frågor, några kan ge fler minus
    'P VPK' => 7, # 7 frågor
  );

$info =
  array(
        'P TAV' => '1 om svaret inte är helt korrekt (konstnär, tavla + årtal)',
        'P TVÄ' => '1-2 per fel',
        'P .*' => '1 per fel',
        // 'ÖppReb' => '50',

        // inga stjälpplock
      //   'ÖppPlk' => '60',
      //   'StjPlk' => '-10 per bild',
        'Stil' => 'Ner till -30',
        'Tid S' => '1 per minut',
      //   'Tid L' => '1 per minut',
        'Tid M' => '1 per minut efter 2,5 timme. 2 per minut efter 2,5-3,5 timme',
        'R [0-9]+' => '25 klippt hjälp, 45 klippt nöd',
        'X [0-9]+' => '-10 korrekt motiverad lösning',
        'FP [0-9]+' => '10 missat plock, 20 falskt plock',
        // inga tallriksplock
      //   'TP 9' => '-5 per korrekt tema',
      //   'TP [0-9]+' => '5 missat plock, 10 falskt plock'
        );
?>
