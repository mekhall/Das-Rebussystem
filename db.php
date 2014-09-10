<?php

require_once "rebus.php";

define('SQLITE_DB', DATAROOT . '/' . NAME . '/db');

function create()
{
    $db = new SQLite3(SQLITE_DB);

    $columns = array();
    $values = array();
    for ($event = 0; $event < count($GLOBALS['events']); ++$event) {
        $columns[] = "event$event INTEGER";
        $values[] = "NULL";
    }

    $c = "CREATE TABLE rebus (team INTEGER PRIMARY KEY, " . implode(',', $columns) . ")";
    $db->query($c);

    for ($team = 0; $team < count($GLOBALS['teams']); ++$team) {
        $db->query("INSERT INTO rebus VALUES ($team, " . implode(',', $values) . ")");
    }
}

function getDb()
{
    static $db;
    static $teamn;
    static $eventn;
    if (!isset($db)) {
        if (!is_readable(SQLITE_DB)) {
            create();
        }
        if (!is_writable(SQLITE_DB)) {
            echo("<p><font color=red>Database " . SQLITE_DB . " not writable.</font></p>\n");
        }
        $db = new SQLite3(SQLITE_DB);
        $db->busyTimeout(1000);
        $teamn = $db->querySingle("SELECT COUNT(*) FROM rebus");
        $e = $db->querySingle("SELECT * FROM rebus WHERE team=0", true);
        $eventn = count($e) - 1;
    }

    if ($teamn == "") {
       $teamn = 0;
    }

    // Fix database if new teams or events are added.
    // Can only handle append at end so pretty useless.
    if (count($GLOBALS['teams']) > $teamn) {
        $values = array();
        for ($event = 0; $event < count($GLOBALS['events']); ++$event) {
            $values[] = "NULL";
        }
        for ($team = $teamn; $team < count($GLOBALS['teams']); ++$team) {
            $db->query("INSERT INTO rebus VALUES ($team, " . implode(',', $values) . ")");
        }
        $teamn = count($GLOBALS['teams']);
    }
    if (count($GLOBALS['events']) > $eventn) {
        for ($event = $eventn; $event < count($GLOBALS['events']); ++$event) {
            $db->query("ALTER TABLE rebus ADD COLUMN event$event INTEGER DEFAULT NULL");
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

    return $row;
}

function getEventPoints($event, $event2 = null)
{
    $db = getDb();
    if (is_null($event2)) {
        $q = "SELECT team, event$event FROM rebus";
    }
    else {
        $q = "SELECT team, event$event, event$event2 FROM rebus";
    }
    $rows = $db->query($q);
    while ($row = $rows->fetchArray()) {
        $v = $row[1];
        if (is_null($v)) {
            $v = 0;
        }
        if (is_null($event2)) {
            $result[$row[0]] = $v;
        }
        else {
            $v1 = $row[2];
            if (is_null($v1)) {
                $v1 = 0;
            }
            $result[$row[0]] = array($v, $v1);
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
