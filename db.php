<?php

require_once "rebus.php";

define('SQLITE_DB', DATAROOT . '/' . SHORT_NAME . '/db');

function create()
{
    $db = new SQLiteDatabase(SQLITE_DB);

    $columns = array();
    $values = array();
    for ($event = 0; $event < count($GLOBALS['events']); ++$event) { 
        $columns[] = "event$event INTEGER";
	$values[] = "NULL";
    }

    $c = "CREATE TABLE rebus (team INTEGER PRIMARY KEY, " . implode(',', $columns) . ")";
    $db->queryExec($c);

    for ($team = 0; $team < count($GLOBALS['teams']); ++$team) {
	$db->queryExec("INSERT INTO rebus VALUES($team, " . implode(',', $values) . ")");
    }
}

function getDb()
{
    static $instance;
    if (!isset($instance)) {
	if (!is_readable(SQLITE_DB)) {
	    create();
	}
	$instance = new SQLiteDatabase(SQLITE_DB);
    }
    return $instance;
}

function convert()
{
    copy(SQLITE_DB, SQLITE_DB . '.old');

    $db = getDb();

    create();

    for ($team = 0; $team < count($GLOBALS['teams']); ++$team) {
	for ($event = 0; $event < count($GLOBALS['events']); ++$event) { 
	    $p = $db->singleQuery("SELECT points FROM team$team WHERE event=$event");
	    setPoints($team, $event, $p);
	}
    }
    for ($team = 0; $team < count($GLOBALS['teams']); ++$team) {
	$db->queryExec("DROP TABLE team$team");
    }
}

function setPoints($team, $event, $points)
{
    $db = getDb();

    if ($points == '') {
	$points = 'NULL';
    }

    if ($points != 'NULL' and !is_numeric($points)) {
	return;
    }

     $db->queryExec("UPDATE rebus SET event$event=$points WHERE team=$team");
}

function getPoints($team, $event)
{
    $db = getDb();

    $row = $db->singleQuery("SELECT event$event FROM rebus WHERE team=$team");

    return $row;
}

function getEventPoints($event, $event2 = null)
{
    for ($team = 0; $team < count($GLOBALS['teams']); ++$team) {
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
    for ($team = 0; $team < count($GLOBALS['teams']); ++$team) {
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
    for ($team = 0; $team < count($GLOBALS['teams']); ++$team) {
	if (!isset($data[$team])) {
	    $data[$team] = 0;
	}
	$data[$team] += getPoints($team, $event);
    }
    
}
?>
