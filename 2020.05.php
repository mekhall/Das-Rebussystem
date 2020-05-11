<?php

require_once 'slide.php';

$teams = array(
      // Name => (number, number of members, flair)
      // Available flairs: <small>, <blue>, <smallblue>, <alien>
      'Blodbussen'            => array(0, 1,),
      'Ingen Aning'           => array(1, 1),
      '1 till 2 till'         => array(2, 1),
      'Trial & Error'         => array(3, 1),
      'Webus Express'         => array(4, 1),
      'RRL'                   => array(5, 1),
      'Enar'                  => array(6, 1),
      'Åkered'                => array(7, 1),
      'Så att säga'           => array(8, 1),
      'Puh – Det mörka hotet' => array(9, 1),
      'Ibsens kusiner'        => array(10, 1),
      'I Saw A Tiger'         => array(11, 1),
      'Goa Gubbar'            => array(12, 1),
      'Ej i trafik'           => array(13, 1),
      'Bilfri Barlast'        => array(14, 1),
      'Suddens Bergsmyntor'   => array(15, 1),
      'Öset Luhring'          => array(16, 1),
	  'Örnen 5'               => array(17, 1),
	  'Re: Flexbussen'        => array(18, 1),
	  'Katlas kompisar'       => array(19, 1),
	  'Viktat Projektivt Rum' => array(20, 1),
	  'Rattmuffarna'          => array(21, 1),
	  'Hurdy Gurdy'           => array(22, 1),
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

      // Pyssel
      'P DIS' => 'Disneydags',
      'P HEN' => 'Hen!',
	  'P NYO' => 'Nyordslistan',
	  'P NDD' => 'När då då',
      'P OKA' => 'Okända djur',
      'P REN' => 'Rena grekiskan',
      'P TAG' => 'Tag det rätta.. tag google translate',
	  'P TEX' => 'Textion',
	  'P UPP' => 'Uppdrag granskning',
      
      'Stil' => 'Stil och finess',
	  'Sport' => 'Sportsmanship',
	  'Demo' => 'Klarat demot',
      
      'Tid S' => 'Tidsprickar vid Start',
      'Tid L' => 'Tidsprickar vid Lunch',
      'Tid M' => 'Tidsprickar vid Mål',
            
      'FP 1' => 'Fotoplock 1',
      'FP 2' => 'Fotoplock 2',
      'FP 3' => 'Fotoplock 3',
      'FP 4' => 'Fotoplock 4',
      'FP 5' => 'Fotoplock 5',
      'FP 6' => 'Fotoplock 6',
      'FP 7' => 'Fotoplock 7',
      'FP 8' => 'Fotoplock 8',
      'BPlk' => 'Öppnat stjälpplock'
);

$parts = array(
      '*picture*RebusVrally VT 2020:bil1.png',

      
      'Etapp 1' => array(
			'Demo',
            'Tid S',
			'Sport',
            'R 1',
            '*picture*Disneydags!:disney.png', 
            'P DIS',
	    'BPlk',
            'FP 1'
      ),
      
      'Etapp 2' => array(
            '*picture*Hen!:hen.jpg',
            'P HEN',
            'R 2',
            'FP 2'
      ),
      'Totalt efter Etapp 2' => array('*sumcomp*', 'Etapp 1', 'Etapp 2'),
      
      'Etapp 3' => array(
            '*picture*Okända djur:krubbgnask.jpg',
	    'P OKA', 
            'R 3',
            'FP 3'
      ),
      'Totalt efter Etapp 3' => array('*sumcomp*', 'Totalt efter Etapp 2', 'Etapp 3'),
      
      'Etapp 4' => array(
            '*picture*Tag det rätta.. tag google translate:translate.jpg',
	    'P TAG', 
            'R 4',
            'FP 4',
	    'Tid L'
      ),
      'Totalt efter Etapp 4' => array('*sumcomp*', 'Totalt efter Etapp 3', 'Etapp 4'),

      '*sorted*Stil',

      'Etapp 5' => array(
            'R 5',
			'*picture*Rena grekiskan:grekiska.jpg',
	    'P REN',
		'*picture*Textion:rolandz.png',
		'P TEX',
            'FP 5'
      ),
      'Totalt efter Etapp 5' => array('*sumcomp*', 'Totalt efter Etapp 4', 'Etapp 5'),
      
      'Etapp 6' => array(
      	     'R 6',
			 '*picture*Nyordslistan:nyord.jpg',
			 'P NYO',
	     'FP 6'
      ),

      'Totalt efter Etapp 6' => array('*sumcomp*', 'Totalt efter Etapp 5', 'Etapp 6'),
      
      'Etapp 7' => array(
      	     'R 7',
			 'P NDD',
	     'FP 7'
	     ),

      'Totalt efter Etapp 7' => array('*sumcomp*', 'Totalt efter Etapp 6', 'Etapp 7'),
            
      'Etapp 8' => array(
      	     'R 8',
			 '*picture*Uppdrag granskning:bruce.png',
			 'P UPP',
	     'FP 8',
	     'Tid M'),
      
	  '*picture*Bäst på plock idag:fotoplock.jpg',
      'Plock totalt' =>
      array('*sum*',
            'FP 1', 'FP 2', 'FP 3', 'FP 4', 'FP 5', 'FP 6', 'FP 7', 'FP 8', 'BPlk'),
      
	  '*picture*Pysselmästare:pyssel.png',	  
      'Pyssel totalt' =>
      array('*sum*',
      'P DIS', 'P HEN', 'P TAG', 'P REN', 
      'P OKA', 'P NYO', 'P NDD', 'P TEX', 'P UPP'),
      
	  '*picture*Bästa rebuslösarna:rebus.jpg',
      'Rebusar totalt' =>
      array('*sum*',
      'R 1', 'R 2', 'R 3', 'R 4',
      'R 5', 'R 6', 'R 7', 'R 8'),

	  '*picture*Bästa rebuslösarna:proud.jpg',
	  '*picture*Totalt:much_wow.jpg',      
	  '*picture*Totalt:arbetets_ara.jpg',
      'Totalt' => array('*sum*', 'Totalt efter Etapp 7', 'Etapp 8', 'Stil'),
      
      '*picture*RebusVrally VT 2020 - Grattis vinnarna - Vi syns 12 september!:ht20.png',      
);

$maxPoints = array(
      'P DIS' => 15,
      'P OKA' => 20,
      'P HEN' => 12,
      'P REN' => 18,
      'P TAG' => 13,
	  'P NYO' => 20,
	  'P NDD' => 15,
	  'P TEX' => 15,
	  'P UPP' => 20
);

$info =
array(
      'Tid S' => '1 per minut',
      'Tid L' => '1 per minut',
      'Tid M' => '1 per minut',
      'R [0-9]+' => '25 klippt hjälp, 45 klippt nöd',
      'S [0-9]+' => '-10 korrekt motiverad lösning',
      'FP [0-9]+' => '10 missat plock, 20 falskt plock',
      //'TP 9' => '-5 per korrekt tema',
      //'TP [0-9]+' => '5 missat plock, 10 falskt plock'
);
?>
