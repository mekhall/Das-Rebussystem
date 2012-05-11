<?php

require_once "rebus.php";

define('SQLITE_DB', DATAROOT . '/' . NAME . '/db');

function create()
{
    $GLOBALS['error_messages'] = $GLOBALS['error_messages']."ERROR not a valid database. Creating a new one!<br>\n."; 
    $db = new SQLite3(SQLITE_DB);

    $columns = array();
    $values = array();
    for ($event = 0; $event < count($GLOBALS['events']); ++$event) { 
        $columns[] = "event$event INTEGER";
	$values[] = "NULL";
	$GLOBALS['error_messages'] = $GLOBALS['error_messages']."event$event INTEGER<br>\n."; 
    }

    $c = "CREATE TABLE rebus (team INTEGER PRIMARY KEY, " . implode(',', $columns) . ")";
    $GLOBALS['error_messages'] = $GLOBALS['error_messages']."CREATE TABLE rebus (team INTEGER PRIMARY KEY, " . implode(',', $columns) . ")<br>\n."; 
    $db->query($c);

    for ($team = 0; $team < count($GLOBALS['teams']); ++$team) {
	$db->query("INSERT INTO rebus VALUES ($team, " . implode(',', $values) . ")");
	$GLOBALS['error_messages'] = $GLOBALS['error_messages']."INSERT INTO rebus VALUES ($team, " . implode(',', $values) . ")<br>\n."; 
    }
}

function getDb()
{
    static $db;
    static $teamn;
    static $eventn;
    if (!isset($db)) {
	$GLOBALS['error_messages'] = $GLOBALS['error_messages']."db not set $db<br>\n."; 
	if (!is_readable(SQLITE_DB)) {
	    $GLOBALS['error_messages'] = $GLOBALS['error_messages']."db not readable $db<br>\n."; 
	    create();
	}
	$db = new SQLite3(SQLITE_DB);
	$teamn = $db->querySingle("SELECT COUNT(*) FROM rebus");
	$e = $db->querySingle("SELECT * FROM rebus WHERE team=0", true);
	$eventn = count($e) - 1;
    }

    $teams_in_setup = count($GLOBALS['teams']);
    if (count($GLOBALS['teams']) > $teamn) {
	$GLOBALS['error_messages'] = $GLOBALS['error_messages']."teams in db is less than in setup:$teamn<$teams_in_setup<br>\n."; 
    	$values = array();
	for ($event = 0; $event < count($GLOBALS['events']); ++$event) { 
	    $values[] = "NULL";
	}
	for ($team = $teamn; $team < count($GLOBALS['teams']); ++$team) {
	    $db->query("INSERT INTO rebus VALUES ($team, " . implode(',', $values) . ")");
	}
	$teamn = count($GLOBALS['teams']);
    }
    $events_in_setup = count($GLOBALS['events']);
    if (count($GLOBALS['events']) > $eventn) {
    	$GLOBALS['error_messages'] = $GLOBALS['error_messages']."events in db are less than in setup:$eventn<$eventss_in_setup<br>\n."; 
	for ($event = $eventn; $event < count($GLOBALS['events']); ++$event) { 
	    $db->query("ALTER TABLE rebus ADD COLUMN event$event INTEGER DEFAULT NULL");
	    $GLOBALS['error_messages'] = $GLOBALS['error_messages']."ERROR event numbers not matching. Adding event $event.<br>\n"; 
	}
	$eventn = count($GLOBALS['events']);
    }

    return $db;
}

function convert()
{
    copy(SQLITE_DB, SQLITE_DB . '.old');

    $db = getDb();

    create();

    for ($team = 0; $team < count($GLOBALS['teams']); ++$team) {
	for ($event = 0; $event < count($GLOBALS['events']); ++$event) { 
	    $p = $db->querySingle("SELECT points FROM team$team WHERE event=$event");
	    setPoints($team, $event, $p);
	}
    }
    for ($team = 0; $team < count($GLOBALS['teams']); ++$team) {
	$db->query("DROP TABLE team$team");
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

     $db->query("UPDATE rebus SET event$event=$points WHERE team=$team");
}

function getPoints($team, $event)
{
    $db = getDb();

    $row = $db->querySingle("SELECT event$event FROM rebus WHERE team=$team");

#    if ($row != 'NULL' and !is_numeric($row)){
#       $GLOBALS['error_messages'] = $GLOBALS['error_messages']."ERROR not a valid return value:$row for event $event team $team<br>\n"; 
#    }
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
