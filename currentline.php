<?php
$nr = array_key_exists('nr', $_GET) ? $_GET['nr'] : -1;
$line = array_key_exists('line', $_GET) ? $_GET['line'] : -1;

if ($nr > -1 && $line > -1) {
  file_put_contents("current", $nr . ":" . $line);
}

?>
