<?php

require_once 'rebus.php';
require_once 'rebus_util.php';
require_once 'slide.php';

$actions = array();

foreach ($parts as $part => $data) {
    if (is_string($data) and array_key_exists($data, $events)) {
        array_push($actions, new EventSlide($events[$data], $data));
    }
    elseif (is_string($data) and preg_match('/^\*sorted\*(.+)/', $data, $matches)) {
      $e = $matches[1];
      array_push($actions, new EventSlide($events[$e], $e, null, 0, 1));
    }
    elseif (is_string($data) and preg_match('/^\*picture\*(.+):(.+)/', $data, $matches)) {
        $pic = $matches[2];
        if (checkPic($pic)) {
            array_push($actions, new PictureSlide($matches[1], $pic));
        }
        else {
            echo "ERROR: Could not find picture '$pic'<br>";
        }
    }
    elseif ($data[0] == '*sum*') {
        array_push($actions, new SumSlide($part, $data));
    }
    elseif ($data[0] == '*sumcomp*') {
        array_push($actions, new SumCompSlide($part, $data));
    }
    else {
        if (preg_match('/Etapp ([0-9]+)/', $part, $matches)) {
            $n = $matches[1];
            $pic = "etapp$n";
            if (checkPic($pic)) {
                array_push($actions, new PictureSlide($part, $pic));
            }
        }

        foreach ($data as $e) {
            if (!is_string($e)) {
                if (is_array($e) and $e[0] == '*esum*') {
                    array_push($actions, new SumSlide($e[1], array_slice($e, 2)));
                }
                elseif (is_subclass_of($e, 'Slide')) {
                    array_push($actions, $e);
                }
            }
            else {
                if (preg_match('/^R ([0-9]+)/', $e, $matches)) {
                    // Rebus
                    $n = $matches[1];
                    $eventName = $events[$e];
                    array_push($actions, new SolutionSlide('R', $n));
                    if (in_array($n, $GLOBALS['bluerebus'])) {
                        array_push($actions, new SolutionSlide('B', $n));
                    }
                    array_push($actions, new SolutionSlide('H', $n));
                    array_push($actions, new EventSlide($eventName, $e));
                }
                elseif (preg_match('/^S ([0-9]+)/', $e, $matches)) {
                    // Stjälprebus
                    $n = $matches[1];
                    $eventName = $events[$e];
                    array_push($actions, new SolutionSlide('S', $n));
                    array_push($actions, new EventSlide($eventName, $e));
                }
                elseif (preg_match('/^X ([0-9]+)/', $e, $matches)) {
                    // Bonusrebus
                    $n = $matches[1];
                    $eventName = $events[$e];
                    array_push($actions, new SolutionSlide('X', $n));
                    array_push($actions, new EventSlide($eventName, $e));
                }
                elseif (preg_match('/^Y ([0-9]+)/', $e, $matches)) {
                    // Rebusredovisning utom tävlan - har ingen poängpresentation
                    $n = $matches[1];
                    $eventName = $events[$e];
                    array_push($actions, new SolutionSlide('Y', $n, $eventName));
                }
                elseif (preg_match('/^P (.*)/', $e, $matches)) {
                    // Pyssel
                    $n = $matches[1];
                    $eventName = $events[$e];
                    $pic = "gren$n";
                    if (checkPic($pic)) {
                        array_push($actions, new PictureSlide($eventName, $pic));
                    }
                    $pic = "$n";
                    if (checkPic($pic)) {
                        array_push($actions, new PictureSlide($eventName, $pic));
                    }
                    if (array_key_exists($e, $maxPoints)) {
                        array_push($actions, new EventSlide($eventName, $e, null, $maxPoints[$e]));
                    }
                    else {
                        array_push($actions, new EventSlide($eventName, $e));
                    }
                }
                elseif (preg_match('/^[FT]P ([0-9]+)/', $e, $matches)) {
                    // Foto- och tallricksplock.
                    $eventName = $events[$e];
                    $pic = "gren$e";
                    if (checkPic($pic)) {
                        array_push($actions, new PictureSlide($eventName, $pic));
                    }
                    if (array_key_exists($e . 'V', $events)) {
                        $eventName = $events[$e . 'V'];
                        array_push($actions, new EventSlide($eventName,
                                                            $e . 'V', $e . 'H'));
                    }
                    else {
                        array_push($actions, new EventSlide($eventName, $e));
                    }
                }
                elseif (preg_match('/^\*picture\*(.+):(.+)/', $e, $matches)) {
                    $pic = $matches[2];
                    if (checkPic($pic)) {
                        array_push($actions, new PictureSlide($matches[1], $pic));
                    }
                    else {
                        echo "ERROR: Could not find picture '$pic'<br>";
                    }
                }
                elseif (preg_match('/^\*solution\*(.)(.+)/', $e, $matches)) {
                    array_push($actions, new SolutionSlide($matches[1], $matches[2]));
                }
                else {
                    // Övrigt, tex öppnade stjälp.
                    $eventName = $events[$e];
                    $pic = "gren$e";
                    if (checkPic($pic)) {
                        array_push($actions, new PictureSlide($eventName, $pic));
                    }
                    array_push($actions, new EventSlide($eventName, $e));
                }
            }
        }
        array_push($actions, new SumSlide('Summering ' . $part, $part));
    }
}

?>
