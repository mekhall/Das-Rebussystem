<?php

require_once 'db.php';

if (isset($_GET['data'])) {
   setPoints($_GET['team'], $_GET['event'], $_GET['data']);
}
else if (isset($_GET['done_percentage'])) {
   echo json_encode(array(getDonePercentage()));
}
else {
   echo json_encode(array('event' => $_GET['event'],
                          'points' => getEventPoints($_GET['event'])));
}

?>
