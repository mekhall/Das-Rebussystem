<?php

require_once 'rebus.php';

function checkPic(&$name)
{
    $pic = PICTURE_PATH . $name;
    if (is_readable($pic . ".jpg")) {
	$name = PICTURE_URL . $name . ".jpg";
	return 1;
    }
    if (is_readable($pic . ".gif")) {
	$name = PICTURE_URL . $name . ".gif";
	return 1;
    }
    if (is_readable($pic . ".png")) {
	$name = PICTURE_URL . $name . ".png";
	return 1;
    }
    return 0;
}

function getEventNumber($event) 
{
    $i = 0;
    foreach ($GLOBALS['events'] as $e => $ename) {
	if ($e == $event) {
	    return $i;
	}
	++$i;
    }
    echo "ERROR: Could not find $event<br>";
}

function getTeamName($number)
{
    $i = 0;
    foreach ($GLOBALS['teams'] as $tname => $v) {
        $tnumber = $v[0];
	if ($i == $number) {
	    return $tname;
	}
	++$i;
    }
}

function getTeamNumber($number)
{
    $i = 0;
    foreach ($GLOBALS['teams'] as $tname => $v) {
        $tnumber = $v[0];
	if ($i == $number) {
	    return $tnumber;
	}
	++$i;
    }
}

function getPartEvents($part)
{
    $result = array();
    if (array_key_exists($part, $GLOBALS['parts'])) {
	$events = $GLOBALS['parts'][$part];
	foreach ($events as $e) {
	    if (!is_string($e)) {
	    }
	    elseif ($e == '*sum*') {
	    }
	    elseif (array_key_exists($e, $GLOBALS['parts'])) {
		$result = array_merge($result, getPartEvents($e));
	    }
	    else {
		array_push($result, $e);
	    }
	}
    }
    else {
	$result = array($part);
    }
    $result1 = array();
    foreach ($result as $e) {
	if (preg_match('/[TF]P [0-9]+$/', $e)) {
	    if (array_key_exists($e . 'V', $GLOBALS['events'])) {
		array_push($result1, $e . 'V');
		array_push($result1, $e . 'H');
	    }
	    else {
		array_push($result1, $e);
	    }
	}
	else {	
	    array_push($result1, $e);
	}
    }
    return $result1;
}

?>
