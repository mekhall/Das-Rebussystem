<?php

require_once "rebus.php";

define('SQLITE_DB', DATAROOT . '/' . SHORT_NAME . '/db');

function setTestData()
{
    for ($event = 0; $event <= count($GLOBALS['events']) - 1; ++$event) {
	$d = file(DATA_PATH . $event . '.txt');
	$data = preg_split("/\s/", $d[0]);
	for ($team = 0; $team <= count($GLOBALS['teams']) - 1; ++$team) {
	    setPoints($team, $event, $data[$team]);
	}
	echo "Event $event<br>";
    }
}

function checkAndCreate($team, $event)
{
    $db = new SQLiteDatabase(SQLITE_DB);
    $row = $db->singleQuery("SELECT * FROM sqlite_master WHERE name='team$team'");
    if (count($row) == 0) {
	$db->queryExec("CREATE TABLE team$team (event int, points int)");
	for ($i = 0; $i <= $event; ++$i) {
	    $db->queryExec("INSERT INTO team$team VALUES ($i, NULL)");
	}
    }
    else {
	$result = $db->query("SELECT * FROM team$team");
	$n = $result->numRows();
	if ($n <= $event) {
	    for ($i = $n; $i <= $event; ++$i) {
		$db->queryExec("INSERT INTO team$team VALUES ($i, NULL)");
	    }
	}
    }
}

function setPoints($team, $event, $points)
{
    checkAndCreate($team, $event);

    if ($points == '') {
	$points = 'NULL';
    }

    $db = new SQLiteDatabase(SQLITE_DB);
    $db->queryExec("UPDATE team$team SET points=$points WHERE event=$event");
}

function getPoints($team, $event)
{
    checkAndCreate($team, $event);

    $dbh = new SQLiteDatabase(SQLITE_DB);
    $row = $dbh->singleQuery("SELECT points FROM team$team WHERE event=$event");

    return $row;
}

function getEventPoints($event, $event2 = null)
{
    for ($team = 0; $team <= count($GLOBALS['teams']) - 1; ++$team) {
	if (is_null($event2)) {
	    $result[$team] = getPoints($team, $event);
	}
	else {
	    $result[$team] = array(getPoints($team, $event), 
				   getPoints($team, $event2));
	}
    }
    return $result;
}

function getAvgEventPoints($event, $event2 = null)
{
    $result = 0;
    for ($team = 0; $team <= count($GLOBALS['teams']) - 1; ++$team) {
	if (is_null($event2)) {
	    $result += getPoints($team, $event);
	}
	else {
	  $result += getPoints($team, $event) + getPoints($team, $event2);
	}
    }
    return $result / count($GLOBALS['teams']);
}

function updateEventPoints(&$data, $event)
{
    for ($team = 0; $team <= count($GLOBALS['teams']) - 1; ++$team) {
	if (!isset($data[$team])) {
	    $data[$team] = 0;
	}
	$data[$team] += getPoints($team, $event);
    }
    
}
?>
