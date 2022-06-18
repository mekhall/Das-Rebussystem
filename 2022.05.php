<?php

require_once 'slide.php';

$teams = array(
               // Name => (number, number of members, flair)
               // Available flairs: <small>, <blue>, <smallblue>
               'Webus Express'             => array('1,1', 1),
               'Katlas Kompisar'           => array(3, 1),
               'Enar Åkered'               => array(2, 1),
               'Viktat projektivt rum'     => array(14, 1),
               'Blodbussen'                => array(112, 1),
               'RRL för Claes Elfsberg'    => array(42, 1),
               'Ibsens Kusiner'            => array(5, 1),
               'Sötgötarna'                => array(6, 1),
               'Öset Luhring'              => array(7, 1),
               'Senaste Laget'             => array(8, 1),
               'Rattmuffarna'              => array(0, 1),
               'Så att säga'               => array(31, 1, '<small>'),
               'Puh, det mörka hotet'      => array(9, 1),
               'Pirates of the Car-ibbean' => array(10, 1, '<smallblue>')
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
    'P MUS' => 'Das Musikkryss',
    'P ÖÖL' => 'Das Bier',
    'P FRS' => 'Das ist fürst',
    'P DRD' => 'Dr Dr',
    'P DUM' => 'Dummartecken',
    'P ENG' => 'I Speak Floating English',
    'P DÖD' => 'Jag är döden',

    // Lunchpyssel
    'P SMA' => 'Smakprov - vitt klägg',
    'P BID' => 'Tipzpromenad',

    // Pyssel heldag
    'P HEM' => 'Kommer du för att hämta mig',
    'P HEV' => 'Kommer du för att hämta mig - Video',
    'P KRY' => 'Kryptiskt korsord',
    'P MEG' => 'Megasudoku',
    'P SEK' => 'Sekvenser',
    'P SVE' => 'Svengelska',
    'P KED' => 'tanKedjan',

    'Stil' => 'Stil och finess',

    'Tid S' => 'Tidsprickar vid Start',
    'Tid L' => 'Tidsprickar vid Lunch',
    'Tid M' => 'Tidsprickar vid Mål',

    'TP MDF' => 'Fläskspotting',
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
    '*picture*Rebusrally 2022-05:trial-error.gif',
    //'*picture*Start:start.jpg',

    'Etapp 1' => array('Tid S', 'R 1', 'P KRY', 'P ÖÖL', 'TP 1', 'FP 1'),

    'Etapp 2' => array('R 2', 'P FRS', 'P DÖD', 'TP 2', 'FP 2'),
    'Totalt efter Etapp 2' => array('*sumcomp*', 'Etapp 1', 'Etapp 2'),

    'Etapp 3' => array('R 3', 'P DRD', 'P ENG', 'TP 3', 'FP 3'),
    'Totalt efter Etapp 3' => array('*sumcomp*', 'Totalt efter Etapp 2', 'Etapp 3'),

    'Etapp 4' => array('R 4', 'P DUM', 'TP 4', 'FP 4', 'Tid L'),
    'Totalt efter Etapp 4' => array('*sumcomp*', 'Totalt efter Etapp 3', 'Etapp 4'),

    'Lunch' =>
    array(
          //'*picture*Lunch:lunch.jpg',
	  'P SMA',
	  'P BID',
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

    'Etapp 5' => array('R 5', 'P HEM', 'P HEV',
          //'*picture*VIDEO:video.mp4',
          'P MUS', 'TP 5', 'FP 5'),
    'Totalt efter Etapp 5' => array('*sumcomp*', 'Totalt efter Lunch', 'Etapp 5'),

    'Etapp 6' => array('R 6', 'P MEG', 'P SEK', 'TP 6', 'FP 6'),
    'Totalt efter Etapp 6' => array('*sumcomp*', 'Totalt efter Etapp 5', 'Etapp 6'),

    'Etapp 7' => array('R 7', 'P SVE', 'TP MDF', 'TP 7', 'FP 7'),
    'Totalt efter Etapp 7' => array('*sumcomp*', 'Totalt efter Etapp 6', 'Etapp 7'),

    'Etapp 8' => array('R 8', 'P KED', 'TP 8', 'TP 9', 'FP 8', 'Tid M'),

    '*picture*Prisutdelning:lurar.jpg',

    //'*picture*Karta:karta.jpg',

    // Stilpris
    '*picture*Stilpriset:trophy.jpg',
    //'*picture*1 till 2 till:stil.jpg',
    //'*picture*Blodpåse:blod.jpg',
    '*sorted*Stil',

    // Plockpris
    '*picture*Bästa plockare:plockpriset.png',
    'Plock totalt' =>
    array('*sum*',
          'TP 1', 'TP 2', 'TP 3', 'TP 4', 'TP 5', 'TP 6', 'TP 7', 'TP 8',
          'TP 9',
          'FP 1', 'FP 2', 'FP 3', 'FP 4', 'FP 5', 'FP 6', 'FP 7', 'FP 8',
	  'TP MDF',
          'ÖppPlk', 'StjPlk'),

    // Pysselpriset
    '*picture*Pysselpriset:pysselpriset.png',
    'Pyssel totalt' =>
    array('*sum*',
          'P MUS', 'P ÖÖL', 'P FRS', 'P DRD', 'P DUM', 'P ENG',
          'P DÖD', 'P SMA', 'P BID', 'P HEM', 'P HEV', 'P KRY',
          'P MEG', 'P SEK', 'P SVE', 'P KED'),

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
    '*picture*Ständiga tvåan:trophy.jpg',
    'Ständiga tvåan' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8', 'Stil'),
    '*picture*Blåbärspriset:trophy.jpg',
    'Blåbärspriset' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8', 'Stil'),
    '*picture*Bästa småbil:trophy.jpg',
    'Bästa småbil' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8', 'Stil'),
    '*picture*Bästa utlänska lag:trophy.jpg',
    'Bästa utlänska lag' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8', 'Stil'),
    '*picture*Mittenpriset:mittenpriset.png',
    'Mittenpriset' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8', 'Stil'),
    '*picture*Sura trean:trophy.jpg',
    'Sura trean' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8', 'Stil'),
    '*picture*SaS kula på en pinne:trophy.jpg',
    '*picture*Backpriset:trophy.jpg',
    //'*picture*XXXX:back.jpg'
    '*picture*Läggarpinnen:trophy.jpg'
    );

$maxPoints =
  array(
    'P MUS' => 17, # 17 frågor
    'P ÖÖL' => 21, # 21 frågor
    'P FRS' => 21, # 21 frågor, tre delsvar
    'P DRD' => 22, # 22 frågor
    'P DUM' => 18, # 18 frågor
    'P ENG' => 20, # 10 frågor, två delsvar
    'P DÖD' => 20, # 20 frågor
    'P SMA' => 12, # 6 frågor
    'P BID' => 24, # 12 frågor
    'P HEM' => 30, # 15 frågor, tre delsvar
    'P KRY' => 26, # 26 frågor
    'P MEG' => 25, # 25 för helt fel, annars bedömning
    'P SEK' => 23, # 23 frågor, två delsvar
    'P SVE' => 19, # 19 frågor, tre delsvar
    'P KED' => 19, # 19 bilder
  );

$info =
  array(
        'P FRS' => '<red>0.33 per fel delsvar',
        'P ENG' => '<red>1 per fel delsvar',
        'P SMA' => '<red>2 per fel',
        'P BID' => '<red>2 per fel',
        'P HEM' => '<red>0.66 per fel delsvar',
        'P HEV' => '<red>Bedömning, max -25',
        'P SVE' => '<red>0.5 per fel',
        'P MEG' => '<red>25 för helt fel, annars bedömning',
	'P KED' => '<red>1 per ej använd bild, endast längsta kedjan räknas',
	'TP MDF' => '<red>-10 per korrekt bild, 20 för felaktig',
        'P .*' => '1 per fel',
        'ÖppReb' => '50',
        'ÖppPlk' => '60',
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
