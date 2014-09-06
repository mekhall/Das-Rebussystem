<?php

require_once 'rebus.php';
require_once 'present_setup.php';

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
    }
    else {
      print "Total matches events\n";
    }
  }
}

?>
