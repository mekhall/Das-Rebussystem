#!/usr/bin/php
<?php
global $argv,$argc;
if (count($argv) < 2) {
   echo "$argv[0] <dir>\n";
   exit(1);
}

require_once 'rebus.php';
require_once 'present_setup.php';

$dir = $argv[1];
mkdir($dir, 0755, true);

function dcopy($src, $ddir) {
  $base = basename($src);
  copy($src, "$ddir/$base");
}

dcopy("style.css", $dir);
dcopy("mootools.js", $dir);

foreach (glob(PICTURE_PATH . "*.jpg") as $f) {
  dcopy($f, $dir);
}
foreach (glob(PICTURE_PATH . "*.png") as $f) {
  dcopy($f, $dir);
}
foreach (glob(PICTURE_PATH . "*.gif") as $f) {
  dcopy($f, $dir);
}

chdir($dir);

$GLOBALS['index_links'] = 1;
$GLOBALS['rebus_split'] = 0;

$static = 1;

for ($xnr = 0; $xnr < count($actions); ++$xnr) {
    $_GET['nr'] = $xnr;

    ob_start();
    require 'present.php';

    $out = ob_get_clean();
    $out = preg_replace('/present.php\?nr=(\d+)/', 'page$1.html', $out);
    $out = preg_replace('/present.php\?nr=(.*);/', 'page$1 + ".html";', $out);
    $out = preg_replace('#' . PICTURE_URL . '/?#', '', $out);
    file_put_contents("page$nr.html", $out);
}

copy("page0.html", "index.html");

?>
