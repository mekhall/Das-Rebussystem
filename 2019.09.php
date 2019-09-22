<?php

require_once 'slide.php';

$teams = array(
      // Name => (number, number of members, flair)
      // Available flairs: <small>, <blue>, <smallblue>, <alien>
      'Viktat Projektivt Rum'  => array(1, 1, '<small>'),
      'Webus Express'          => array(22, 1),
      'Senaste Laget'          => array(2, 1),
      '1 till 2 till'          => array(3, 1),
      'Ibsens kusiner'         => array(4, 1),
      'Trial & Error'          => array(5, 1),
      'Reflexbussen'           => array('3,6 R/h', 1),
      'Så att säga'            => array(6, 1, '<small>'), // även alien
      'Katlas Kompisar'        => array(7, 1),
      'Goa gubbar på jul'      => array('031', 1),
      'RRL'                    => array(8, 1),
      'Blodbussen'             => array(112, 1),
      'Sötgötarna'             => array(9, 1, '<alien>'),
      'Focus filiocus'         => array(10, 1, '<smallblue>'),
      'Öset Luhring'           => array(11, 1),
      'Örnen 5'                => array(12, 1),
      'Puh - det mörka hotet'  => array(13, 1, '<small>'),
      'Street Sharks'          => array(14, 1, '<smallblue>'),
      'Suddens bergsmyntor'    => array(15, 1),
);

// Blåbärsrebusar - lämnas tom om det inte finns några
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
      
      // Stjälp (Bonusrebusar)
      'X 1' => 'Bonus 1',
      'X 2' => 'Bonus 2',
      'X 3' => 'Bonus 3',
      'X 4' => 'Bonus 4',
      'X 5' => 'Bonus 5',
      'X 6' => 'Bonus 6',
      'X 7' => 'Bonus 7',
      'X 8' => 'Bonus 8',
      'X 9' => 'Bonus 9',
      'X 10' => 'Bonus 10',
      'X 11' => 'Bonus 11',
      'X 12' => 'Bonus 12',
      //     'ÖppReb' => 'Öppnat bonusrebuskuvert',
      
      //     'ÖppPlk' => 'Öppnat stjälpplockkuvertet',
      //     'StjPlk' => 'Stjälpplock',
      
      //     'Lott' => 'Stjälplott',
      
      // Heldagspyssel
      
      // Förmiddagspyssel
      'P PER' => 'Nu ska vi äta barn!',
      'P MUS' => 'Musikkryss',
      'P VAD' => 'Alias Persson',
      'P BYX' => 'Byxor',
      
      // Heldagspyssel
      'P NAT' => 'Det var en mörk och stormig natt',
      'P STK' => 'Få rätsida på ett avigt pyssel',
      'P RNG' => 'Ett pyssel av rang',
      'P PLA' => '+A',
      
      // Lunchpyssel
      'P TGG' => 'Tuggmotstånd',
      'P YUB' => 'Kända profiler',
      
      // Eftermiddagspyssel
      'P BSS' => 'Enar i mitt hjäääääärrrrrta',
      'P BUP' => 'Beam me up, Luke!',
      'P KOR' => 'Men hur kör du egentligen!?',
      'P DNS' => 'Dansen går',
      
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
      'TP 9' => 'Tallrikstema',     // Används inte - men ta inte bort den för då blir databasen arg :)
      
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
      '*picture*Rebusrally HT 2019:bil1.png',
      //     '*picture*Start:start.jpg',
      
      'Etapp 1' => array(
            'Tid S', 
            '*picture*Nu ska vi äta barn!:perfekt.png', 
            'P PER', 
            'R 1', 'TP 1', 'FP 1'
      ),
      
      'Etapp 2' => array(
            'P VAD', 
            'R 2', 'TP 2', 
            '*picture*Jakttorn:Lagttorn.jpg',
            '*picture*Lagttorn:Jakttorn.jpg',
            '*picture*Svåra tallrikar:JAS.jpg',
            'FP 2'
      ),
      'Totalt efter Etapp 2' => array('*sumcomp*', 'Etapp 1', 'Etapp 2'),
      
      'Etapp 3' => array(
            '*picture*Byxor:byxor.jpg', 'P BYX', 
            'R 3', 'TP 3', 
            '*picture*Svåra tallrikar:Göjeryd.jpg',
            '*picture*Svåra tallrikar:THC.jpg',
            '*picture*Svåra tallrikar:GHB.jpg',
            'FP 3'
      ),
      'Totalt efter Etapp 3' => array('*sumcomp*', 'Totalt efter Etapp 2', 'Etapp 3'),
      
      'Etapp 4' => array(
            '*picture*Musikkryss:eyjafjallajokull.jpg', 'P MUS', 
            'R 4', 'TP 4', 
            '*picture*Svåra tallrikar:BRO.jpg',
            'FP 4', 'Tid L'
      ),
      'Totalt efter Etapp 4' => array('*sumcomp*', 'Totalt efter Etapp 3', 'Etapp 4'),
      
      'Lunch' => array(
            '*picture*Lunch:lunch.jpg',
            //     '*picture*Lunch:lunch_rebus.jpg',
            //     '*picture*Lunch:grill.jpg',
            '*picture*Tuggmotstånd:tuggummi.jpg', 'P TGG',
            'P YUB',
            //     'ÖppPlk', 'StjPlk',
            //     array('*esum*', 'Stjälpplock totalt'), //, 'StjPlk', 'ÖppPlk'),
            //     'Lott',
            //     'ÖppReb',
            'X 1', 'X 2', 'X 3', 
            'X 4', 'X 5', 'X 6', 
            'X 7', 'X 8', 'X 9', 
            'X 10', 
            '*solution*X10sanden',
            'X 11',
            '*solution*X11amerika',
            'X 12',
            //'*solution*S9Rattmuffarna',
            array('*esum*', 'Bonusrebusar totalt',
            //     'ÖppReb',
            'X 1', 'X 2', 'X 3', 'X 4', 'X 5',
            'X 6', 'X 7', 'X 8', 'X 9', 'X 10', 'X 11', 'X 12'),
      ),
      'Totalt efter Lunch' => array('*sumcomp*', 'Totalt efter Etapp 4', 'Lunch'),
      
      'Etapp 5' => array(
            'R 5', 'P BSS',
            'TP 5', 'FP 5'
      ),
      'Totalt efter Etapp 5' => array('*sumcomp*', 'Totalt efter Lunch', 'Etapp 5'),
      
      'Etapp 6' => array('R 6', '*picture*Beam me up, Luke!:fandom.png', 'P BUP', 'TP 6', 'FP 6'),
      'Totalt efter Etapp 6' => array('*sumcomp*', 'Totalt efter Etapp 5', 'Etapp 6'),
      
      'Etapp 7' => array('R 7', '*picture*Men hur kör du egentligen!?:polis.jpg', 'P KOR', 'TP 7', 'FP 7'),
      'Totalt efter Etapp 7' => array('*sumcomp*', 'Totalt efter Etapp 6', 'Etapp 7'),
      
      'Heldag' => array('P NAT', 'P STK', 'P RNG', 'P PLA'),
      
      'Etapp 8' => array('R 8', '*picture*Dansen går:dansen.jpg' , 'P DNS', 'TP 8', 'FP 8', 'Tid M'),
      
      
      
      //     '*picture*Karta:karta.jpg',
      
      // Stilpris
      //     '*picture*Stilpriset:trophy.jpg',
      //     '*picture*1 till 2 till:stil.jpg',
      //     '*picture*Blodpåse:blod.jpg',
      '*sorted*Stil',
      
      // Plockpris
      '*picture*Bästa plockare:fotoplock.jpg',
      'Plock totalt' =>
      array('*sum*',
      'TP 1', 'TP 2', 'TP 3', 'TP 4', 'TP 5', 'TP 6', 'TP 7', 'TP 8',
      //     'TP 9',
      'FP 1', 'FP 2', 'FP 3', 'FP 4', 'FP 5', 'FP 6', 'FP 7', 'FP 8'),
      //     'ÖppPlk', 'StjPlk'),
      
      // Pysselpriset
      '*picture*Pysselpriset:trophy.jpg',
      'Pyssel totalt' =>
      array('*sum*',
      'P PER', 'P MUS', 'P VAD', 'P BYX', 
      'P NAT', 'P STK', 'P RNG', 'P PLA',
      'P BSS', 'P BUP', 'P KOR', 'P DNS',
      'P TGG', 'P YUB'),
      
      // Rebuspriset
      '*picture*Rebuspriset:trophy.jpg',
      'Rebusar totalt' =>
      array('*sum*',
      //     'ÖppReb', 
      'X 1', 'X 2', 'X 3', 'X 4',
      'X 5', 'X 6', 'X 7', 'X 8', 'X 9', 'X 10', 'X 11', 'X 12',
      'R 1', 'R 2', 'R 3', 'R 4',
      'R 5', 'R 6', 'R 7', 'R 8'),
      //     '*picture*Blåbärsrebuspriset:trophy.jpg',
      
      '*picture*Förstapriset:trophy.jpg',
      'Totalt' => array('*sum*', 'Totalt efter Etapp 7', 'Heldag', 'Etapp 8', 'Stil'),
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
      '*picture*Rebusrally HT 2019 - Grattis Trial & Error - Tack för oss!:bil1.png',      
);

$maxPoints = array(
      // FM
      'P PER' => 16,
      'P MUS' => 15,
      'P VAD' => 20,
      'P BYX' => 15,
      // Hel
      'P NAT' => 19,
      'P STK' => 16,
      'P RNG' => 20,
      'P PLA' => 12,
      // Lunch
      'P TGG' => 16,
      'P YUB' => 13,
      // EM
      'P BSS' => 20,
      'P BUP' => 20,
      'P KOR' => 24,
      'P DNS' => 12,
);

$info =
array(
      //   'P RIT' => '<red>0 för kabanoss, 25 för dålig, bedömning från Janne',
      //   'P MÄT' => '<red>0 inom 5%, 1 om 5-15%, 2 annars',
      //   'P SHI' => '<red>2 per fel, -5 om sista rätt',
      //   'P MUL' => '<red>2 per fel',
      //   'P OKW' => '<red>2 per fel',
      //   'P KAR' => '<red>3 per fel',
      //   'P BIL' => '<red>3 per fel',
      //   'P FEM' => '<red>2 per fel',
      //   'P EMO' => '<red>1 per fel låt, 1 per fel artist (en saknar artist)',
      //   'P TET' => '<red>25 om ej löst',
      //   'P .*' => '1 per fel',
      //   'Lott' => '10 för öppnat kuvert',
      //   'ÖppReb' => '30',
      //   'ÖppPlk' => '40',
      //   'StjPlk' => '-5 per bild, -5 per rätt mur',
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
