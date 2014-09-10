<?php

require_once 'rebus.php';
require_once 'present_setup.php';
require_once 'db.php';

$db = getDb();

function filldb()
{
  for ($team = 0; $team < count($GLOBALS['teams']); ++$team) {
    for ($event = 0; $event < count($GLOBALS['events']); ++$event) {
      setPoints($team, $event, rand(-20, 20));
    }
  }
}

foreach ($actions as $a) {
  if ($a->getTitle() == "Totalt") {
    $data = array();

    $all = array();
    foreach ($a->sum as $e) {
      if ($e != '*sum*') {
        foreach (getPartEvents($e) as $e1) {
          array_push($all, $e1);
          updateEventPoints($data, getEventNumber($e1));
        }
      }
    }
    $diff = array_diff($all, array_keys($events));
    if (count($diff) != 0) {
      print "ERROR: Total does not match events\n";
      var_dump($diff);
    }
    $diff = array_diff(array_keys($events), $all);
    if (count($diff) != 0) {
      print "ERROR: Total does not match events\n";
      var_dump($diff);
    }
  }
}

?>
