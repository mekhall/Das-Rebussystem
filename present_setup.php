<?php

require_once 'rebus.php';
require_once 'rebus_util.php';
require_once 'slide.php';

$actions = array();

$pic = "title";
if (checkPic($pic)) {
   array_push($actions, new PictureSlide("Rebusrally " . NAME, $pic));
}

foreach ($parts as $part => $data) {
    if (is_string($data) and array_key_exists($data, $events)) {
        array_push($actions, new EventSlide($events[$data], $data));
    }
    else if ($data[0] == '*sum*') {
        array_push($actions, new SumSlide($part, $data));
    }
    else if ($data[0] == '*sumcomp*') {
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
                if (is_subclass_of($e, 'Slide')) {
                    array_push($actions, $e);
                }
            }
            else {
                if (preg_match('/^R ([0-9]+)/', $e, $matches)) {
                    // Rebus
                    $n = $matches[1];
                    $eventName = $events[$e];
                    array_push($actions, new SolutionSlide('R', $n));
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
                elseif (preg_match('/^P (.*)/', $e, $matches)) {
                    // Pyssel
                    $n = $matches[1];
                    $eventName = $events[$e];
                    $pic = "gren$n";
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
