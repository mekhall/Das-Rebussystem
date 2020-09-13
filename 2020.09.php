<?php

require_once 'slide.php';

$teams = array(
  // Name => (number, number of members, flair)
  // Available flairs: <small>, <blue>, <smallblue>, <alien>
  'Trial & Error / 9'      => array('1/9', 1, '<smallblue>'),
  'Trial & Error / 3'      => array('3/9', 1, '<small>'),
  'Viktat Projektivt Rum'  => array('1', 1, ''),
  'Det ena laget'          => array('2', 1, '<small>'),
  'Det andra laget'        => array('2.5', 1, '<small>'),
  'Ej i trafik'            => array('3', 1, ''),
  'Ibsens kusiner'         => array('4', 1, ''),
  'RRL'                    => array('5', 1, '<alien>'),
  'Suddens bergsmyntor'    => array('6', 1, ''),
  'Örnen 5'                => array('7', 1, ''),
  'Katlas Kompisar'        => array('8', 1, ''),
  'Enar Åkered'            => array('10', 1, ''),
  'I Saw a Tiger'          => array('11', 1, '<blue>'),
  'KARROLUS REX'           => array('XII', 1, '<small>'),
  'Re:flexbussen'          => array('49', 1, '<blue>'),
  'Blodbussen'             => array('112', 1, '')
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
            
  // Förmiddagspyssel
  'P MUS' => 'Musikkryss',
  'P NYA' => 'Nyanserat',
  'P SEK' => 'Sekten är värst',
  'P VAD' => 'VAD gör knappen?',
      
  // Heldagspyssel
  'P BIL' => 'Bildligt talat',
  'P INY' => 'I ny tappning',
  'P FLA' => 'Flaggan i topp',
  'P ORD' => 'Ordkedjan',
      
  // Lunchpyssel
  'P MMM' => 'Mmm... Marlboro',
  'P SOT' => 'Söt eller Göte',
  'P VEM' => 'Vem bor här?',
      
  // Eftermiddagspyssel
  'P SAK' => 'Så kan det låta',
  'P DAR' => '(D)årtal',
  'P DET' => 'DET gör knappen',
  'P SYN' => 'SYNonymer',
  'P TOP' => 'Toppform',
      
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

  'StjPlk' => 'Öppnat stjälpplockkuvertet',
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
  '*picture*Rebusrally HT 2020:buss.png',
      
  'Etapp 1' => array(
    'Tid S', 
    'R 1',
    'TP 1',
    'StjPlk',
    'FP 1',
    '*picture*Musikkryss:ABC_P.png',
    'P MUS',
    '*picture*Nyanserat:ABC_Y.png',
    'P NYA', 
  ),
      
  'Etapp 2' => array(
    'R 2',
    'TP 2', 
    'FP 2',
    '*picture*Sekten är värst:ABC_O.png',
    'P SEK',
    '*picture*VAD gör knappen?:ABC_S.png',
    'P VAD', 
  ),

 'Totalt efter Etapp 2' => array(
   '*sumcomp*',
   'Etapp 1',
   'Etapp 2'
 ),
      
  'Etapp 3' => array(
    'R 3',
    'TP 3', 
    'FP 3',
	'*picture*Bildligt talat:bildligt.png',
    'P BIL',
	'*picture*I ny tappning:ABC_M.png',
    'P INY', 
  ),

  'Totalt efter Etapp 3' => array(
    '*sumcomp*',
    'Totalt efter Etapp 2',
    'Etapp 3'
  ),
      
  'Etapp 4' => array(
    'R 4',
    'TP 4', 
    'FP 4',
	'*picture*Flaggan i topp:ABC_F.png',
    'P FLA', 
	'*picture*Ordkedjan:ABC_R.png',
    'P ORD', 
    'Tid L'
  ),
  
  'Totalt efter Etapp 4' => array(
    '*sumcomp*',
    'Totalt efter Etapp 3',
    'Etapp 4'
  ),
      
  'Lunch' => array(
    '*picture*Mmm Marlboro:ABC_D.png',
    'P MMM',
    'P SOT',
	'*picture*Vem bor här?:ABC_J.png',
    'P VEM',
    'X 1',
    'X 2',
    'X 3', 
    'X 4',
    'X 5',
    'X 6', 
    'X 7',
    'X 8',
    'X 9', 
    'X 10', 
    'X 11',
    'X 12',
    array(
      '*esum*',
      'Bonusrebusar totalt',
      'X 1',
      'X 2',
      'X 3',
      'X 4',
      'X 5',
      'X 6',
      'X 7',
      'X 8',
      'X 9',
      'X 10',
      'X 11',
      'X 12'
    ),
  ),

 'Totalt efter Lunch' => array(
   '*sumcomp*',
   'Totalt efter Etapp 4',
   'Lunch'
  ),
      
  'Etapp 5' => array(
    'R 5',
	'*picture*TP5:GOT.jpg',
    'TP 5',
    'FP 5',
	'*picture*Så kan det låta:ABC_Q.png',
    'P SAK',
	'*picture*(D)årtal:ABC_N.png',
    'P DAR',
  ),

  'Totalt efter Etapp 5' => array(
    '*sumcomp*',
    'Totalt efter Lunch',
    'Etapp 5'
  ),
      
  'Etapp 6' => array(
    'R 6',
	'*picture*TP5:TLC.jpg',
    'TP 6',
    'FP 6',
	'*picture*Toppform:ABC_Z.png',
    'P TOP',
  ),
	
  'Totalt efter Etapp 6' => array(
    '*sumcomp*',
    'Totalt efter Etapp 5',
    'Etapp 6'
  ),
      
  'Etapp 7' => array(
    'R 7',
	'*picture*TP7:RATT.jpg',
	'*picture*TP7:COL.jpg',
	'*picture*TP7:PRY.jpg',
    'TP 7',
    'FP 7',
	'*picture*SYNonymer:ABC_T.png',
    'P SYN',
  ),

  'Totalt efter Etapp 7' => array(
    '*sumcomp*',
    'Totalt efter Etapp 6',
    'Etapp 7'
  ),

  'Etapp 8' => array(
    'R 8',
	'*picture*TP8:laggaretorp.jpg',
	'*picture*TP8:BPF.jpg',
    'TP 8',
    'FP 8',
	'*picture*Det gör knappen:knappen.png',
    'P DET',
    'Tid M'
  ),

  '*sorted*Stil',

  // Plockpriset
  'Plock totalt' =>
    array(
      '*sum*',
      'TP 1',
      'TP 2',
      'TP 3',
      'TP 4',
      'TP 5',
      'TP 6',
      'TP 7',
      'TP 8',
      'FP 1',
      'FP 2',
      'FP 3',
      'FP 4',
      'FP 5',
      'FP 6',
      'FP 7',
      'FP 8',
      'StjPlk'
    ),

   // Rebuspriset
    'Pyssel totalt' =>
      array(
        '*sum*',
        'P MUS',
        'P NYA',
        'P SEK',
        'P VAD',
        'P BIL',
        'P INY',
        'P FLA',
        'P ORD',
        'P MMM',
        'P SOT',
        'P VEM',
        'P SAK',
        'P DAR',
        'P DET',
        'P SYN',
        'P TOP'
      ),
      
   // Rebuspriset
   'Rebusar totalt' =>
     array(
       '*sum*',
       'X 1',
       'X 2',
       'X 3',
       'X 4',
       'X 5',
       'X 6',
       'X 7',
       'X 8',
       'X 9',
       'X 10',
       'X 11',
       'X 12',
       'R 1',
       'R 2',
       'R 3',
       'R 4',
       'R 5',
       'R 6',
       'R 7',
       'R 8'
     ),
      
   'Totalt' => array(
     '*sum*',
     'Totalt efter Etapp 7',
     'Etapp 8',
     'Stil'
   ),
);

$maxPoints = array(
  'P MUS' => 30,
  'P NYA' => 10,
  'P SEK' => 12,
  'P VAD' => 16,
  'P BIL' => 20,
  'P INY' => 20,
  'P FLA' => 20,
  'P ORD' => 20,
  'P MMM' => 14,
  'P SOT' => 15,
  'P VEM' => 13,
  'P SAK' => 22,
  'P DAR' => 20,
  'P DET' => 20,
  'P SYN' => 15,
  'P TOP' => 20
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
