<?php

require_once 'slide.php';

$teams = array(
               // Name => (number, number of members)
	       'Puh - Det mörka hotet' => array(1, 6),
	       'Enar Åkered' => array(2, 6),
	       'RRL för Claes Elfsberg' => array(3, 6),
	       'Katlas kompisar' => array(4, 8),
	       'Metamorphos' => array(5, 4),
	       'Wargen' => array(6, 5),
	       'Blancos Barlast' => array(7, 3),
	       '1 till 2 till' => array(8, 1),
	       'Senaste laget' => array(9, 8),
	       'Bromskolossen' => array(10, 8),
	       'Risk för dåligt väglag' => array(15, 6),
	       'Rattmuffarna' => array(42, 6),
	       'Öset Luhring' => array(98, 7),
	       'Så att säga' => array(99, 6)
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
    'S 12' => 'Stjälp 12',
    'ÖppReb' => 'Öppnat stjälprebuskuvertet',

    'ÖppPlk' => 'Öppnat stjälpplockkuvertet',
    'StjPlk' => 'Stjälpplock',

    'ÖppPyss' => 'Öppnat stjälppysselkuvertet',

    // Heldagspyssel
    'P MUS' => 'Musikkrysset',
    'P BRO' => 'Gissa Brotten',
    'P MAR' => 'Gissa Mårten',
    'P TAT' => 'Gissa Tåten',
    'P HZZ' => 'Uranus Hertz',
    'P TUP' => 'I tuppgropen',

    // Förmiddagspyssel
    'P ALF' => 'Alfabeten', 
    'P PRO' => 'Pocenten, Helge!',
    'P RUS' => 'Rustika rus',
    'P DOD' => 'Död eller levande?',
    'P HOP' => 'Skrivihop',

    // Lunchpyssel
    'P GRI' => 'Slicka på grisen',
    'P TPS' => 'Tipspromenad',

    // Eftermiddagspyssel
    'P STR' => 'Vilken Star Trek-ras?',
    'P FRI' => 'Hockey, hockey',
    'P MAS' => 'Mer hockey',
    'P DIA' => 'Dialektpysslet',
    'P TTM' => 'You talkin\' to me?', 
    'P PYT' => 'Vem är python',

    // Stjälppyssel
    'P BRU' => '17 nyanser av brunt',
    'P BOT' => 'Das boot',
    'P TRA' => 'Träslaget',
    'P SLO' => 'Hertigdömet Östergötland',
    'P SAT' => 'Sattellitter',

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
    'Etapp 1' => array('Tid S', 'R 1', 'P ALF', 'P MUS', 'TP 1', 'FP 1'),

    'Etapp 2' => array('R 2', 'P PRO', 'P BRO', 'TP 2', 'FP 2'),
    'Totalt efter Etapp 2' => array('*sum*', 'Etapp 1', 'Etapp 2'),

    'Etapp 3' => array('R 3', 'P RUS', 'P MAR', 'TP 3', 'FP 3'),
    'Totalt efter Etapp 3' => array('*sum*', 'Totalt efter Etapp 2', 'Etapp 3'),

    'Etapp 4' => array('R 4', 'P DOD', 'P HOP', 'TP 4', 'FP 4', 'Tid L'),
    'Totalt efter Etapp 4' => array('*sum*', 'Totalt efter Etapp 3', 'Etapp 4'),

    'Lunchsummering' => array(new PictureSlide("Lunch", "lunch.jpg"),
                              'P GRI', 'P TPS', 'P TAT', 'P HZZ', 'P TUP', 'ÖppPlk', 'StjPlk',
			      new SumSlide('Stjälpplock totalt', array('StjPlk', 'ÖppPlk')),
			      'ÖppReb',
			      'S 1', 'S 2', 'S 3', 'S 4', 'S 5', 'S 6', 'S 7',
			      'S 8', 'S 9', 'S 10', 'S 11', 
                              new SolutionSlide('S', '11puh'), 'S 12', 
			      new SumSlide('Stjälprebusar totalt',
					   array('ÖppReb', 'S 1', 'S 2', 'S 3', 'S 4',
						 'S 5', 'S 6', 'S 7', 'S 8', 'S 9', 'S 10', 'S 11', 'S 12'))),
    'Totalt efter Lunch' => array('*sum*', 'Totalt efter Etapp 4', 'Lunchsummering'),

    'Etapp 5' => array('R 5', 'P STR', 'P FRI', 'TP 5', 'FP 5'),
    'Totalt efter Etapp 5' => array('*sum*', 'Totalt efter Lunch', 'Etapp 5'),

    'Etapp 6' => array('R 6', 'P MAS', 'P DIA', 'TP 6', 'FP 6'),
    'Totalt efter Etapp 6' => array('*sum*', 'Totalt efter Etapp 5', 'Etapp 6'),

    'Etapp 7' => array('R 7', 'P TTM', 'P PYT', 'TP 7', 'FP 7'),
    'Totalt efter Etapp 7' => array('*sum*', 'Totalt efter Etapp 6', 'Etapp 7'),

    'Stjälppyssel' => array('ÖppPyss', 'P BRU', 'P BOT', 'P TRA', 'P SLO', 'P SAT'),

    'Totalt efter stjälppyssel' => array('*sum*', 'Totalt efter Etapp 7', 'Stjälppyssel'),

    'Etapp 8' => array('R 8', 'TP 8', 'FP 8', 'Tid M'),

    'Stil',

    'Plock totalt inklusive stjälp' => array('*sum*',
			    'TP 1', 'TP 2', 'TP 3', 'TP 4', 'TP 5', 'TP 6', 'TP 7', 'TP 8',
			    'FP 1', 'FP 2', 'FP 3', 'FP 4', 'FP 5', 'FP 6', 'FP 7', 'FP 8',
			    'ÖppPlk', 'StjPlk'),

    'Pyssel totalt inklusive stjälp' => array('*sum*', 
        'P MUS', 'P BRO', 'P MAR', 'P TAT', 'P HZZ', 'P TUP', 
        'P ALF', 'P PRO', 'P RUS', 'P DOD', 'P HOP', 
        'P GRI', 'P TPS', 
        'P STR', 'P FRI', 'P MAS', 'P DIA', 'P TTM', 'P PYT', 
        'ÖppPyss', 'P BRU', 'P BOT', 'P TRA', 'P SLO', 'P SAT'),

    'Rebusar och stjälprebusar totalt' => 
    array('*sum*',
	  'ÖppReb', 'S 1', 'S 2', 'S 3', 'S 4',
	  'S 5', 'S 6', 'S 7', 'S 8', 'S 9', 'S 10', 'S 11', 'S 12',
	  'R 1', 'R 2', 'R 3', 'R 4',
	  'R 5', 'R 6', 'R 7', 'R 8'),

    'Totalt' => array('*sum*', 'Totalt efter stjälppyssel', 'Etapp 8', 'Stil')
    );

$maxPoints = array(
        'P MUS' => 40, 'P BRO' => 20, 'P MAR' => 14, 'P TAT' => 25, 'P HZZ' => 19, 
        'P TUP' => 12, 'P ALF' => 15, 'P PRO' => 15, 'P RUS' => 14, 'P DOD' => 14, 
        'P HOP' => 18, 'P GRI' => 14, 'P TPS' => 13, 'P STR' => 18, 'P FRI' => 14, 
        'P MAS' => 14, 'P DIA' => 19, 'P TTM' => 25, 'P PYT' => 15, 'P BRU' => -17, 
        'P BOT' => -14, 'P TRA' => -18, 'P SLO' => -10, 'P SAT' => -20);

$info = array('P TTM' => '<red>0.5 per fel', 'P GRI' => '<red>2 per fel',
	      'P BRU' => '<red>-1 per rätt',
	      'P BOT' => '<red>-1 per rätt',
	      'P TRA' => '<red>-1 per rätt',
	      'P SLO' => '<red>-1 per rätt',
	      'P SAT' => '<red>-0.5 per rätt',
              'P .*' => '1 per fel',
              'ÖppReb' => '4 per medlem = <4p>', 'ÖppPlk' => '4 per medlem = <4p>', 'ÖppPyss' => '4 per medlem = <4p>',
              'StjPlk' => '-10 per plock',
	      'Tid .' => '1 per minut, 2 efter 17:30',
	      'R [0-9]+' => '25 klippt hjälp, 45 klippt nöd, felaktiga kontrollbokstäver 25',
	      'S [0-9]+' => '-10 korrekt motiverad lösning',
	      'FP [0-9]+' => '10 missat plock, 20 falskt plock',
	      'TP [0-9]+' => '5 missat plock, 10 falskt plock');

?>
