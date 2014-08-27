<?php

define('DATAROOT', dirname(__FILE__));

require_once('rebus_settings.php');

define('PICTURE_URL', NAME . '/');
define('PICTURE_PATH', DATAROOT . '/' . NAME . '/');

require_once NAME . '.php';

?>
