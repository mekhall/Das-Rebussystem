<?php

require_once 'rebus.php';
require_once 'db.php';

echo <<<EOT
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Rebusrally rättning</title>
<style>
.red { background-color: red }
.white { background-color: white }
.cyan { background-color: cyan }
.green { background-color: green }
</style>
<script src="jquery-2.1.4.min.js"></script>
<script>
EOT;

    function fixteam($x) {
        return $GLOBALS['teams'][$x][0] . ': ' . $x;
    }
    echo "    var teams = [\"", implode("\",\"", array_map("fixteam", array_keys($GLOBALS['teams']))), "\"];\n";
    function getmembers($x) {
        return $x[1];
    }
    echo "    var teamsmembers = [\"", implode("\",\"", array_map("getmembers", $GLOBALS['teams'])), "\"];\n";
    function fixpoints($x) {
        if (array_key_exists($x, $GLOBALS['maxPoints'])) {
            return $GLOBALS['maxPoints'][$x];
        }
        else {
            return "";
        }
    }
    echo "    var maxpoints = [\"", implode("\",\"", array_map("fixpoints",
                                                               array_keys($GLOBALS['events']))), "\"];\n";
    echo "    var events = [\"", implode("\",\"", $GLOBALS['events']), "\"];\n";
    function fixinfo($x) {
        foreach ($GLOBALS['info'] as $match => $i) {
            if (preg_match('/^' . $match . '/', $x)) {
                $i = preg_replace('/\<red\>(.*)/', "<font color=red>$1</font>", $i);
                $i = preg_replace('/(.*)\<([0-9]+)p\>(.*)/',
                                  'EVAL:\"$1\" + $2 * teamsmembers[sTeam] + \"$3\"', $i);
                return $i;
            }
        }
        return "&nbsp;";
    }
    echo "    var info = [\"", implode("\",\"", array_map("fixinfo", array_keys($GLOBALS['events']))), "\"];\n";
    echo "\n";
    echo "    var maxEvent = ", count($GLOBALS['events']), ";\n";
    echo "    var maxTeam = ", count($GLOBALS['teams']), ";\n";

echo <<<EOT
var sEvent = 0;
var sTeam = 0;
var lastData = '';
var lastBg = '';
var lastEvent = 0;
var lastTeam = 0;

function getId(team, event) {
    return '#t' + team + 'e' + event;
}

function getColor(e) {
    return $(e).attr('class').replace('box', '').trim();
}

function setColor(e, color) {
    $(e).removeClass().addClass("box " + color);
}

function scrollBarWidth() {
  document.body.style.overflow = 'hidden';
  var width = document.body.clientWidth;
  document.body.style.overflow = 'scroll';
  width -= document.body.clientWidth;
  if (!width) width = document.body.offsetWidth - document.body.clientWidth;
  document.body.style.overflow = '';
  return width;
}

function setData(team, event, data) {
    var id = getId(team, event);
    var c;

    data = String(data);
    if (data == 'null') {
        data = '';
    }

    if (team == sTeam && event == sEvent) {
        c = 'cyan';
        if (data != lastData) {
            $('#status').html('<font color=red>WARNING: DB updated with value \''
                              + data + '\'</font>');
        }
    }
    else if (data == '' || $(id).val() != data) {
        c = data == '' ? 'red' : 'green';
        if (team == sTeam && event == sEvent) {
            // Dont overwrite selected data
        }
        else {
            $(id).val(data);
        }
    }
    else {
        c = 'white';
    }

    setColor(id, c);
}

function setCursor() {
    var i = info[sEvent];
    if (i.substring(0, 5) == 'EVAL:') {
        i = eval(i.substring(5));
    }
    var max = '';
    if (maxpoints[sEvent]) {
        if (i != "&nbsp;") {
            max = ', ';
        }
        max = max + 'max: ' + maxpoints[sEvent];
    }
    $('#team').html(teams[sTeam]);
    $('#event').html(events[sEvent]);
    $('#status').html(i + max);

    if (lastBg != '') {
        var lastid = getId(lastTeam, lastEvent);
        var data = $(lastid).val();
        if (data != '' && lastBg == 'red') {
            lastBg = 'white';
        }
        else if (data == '') {
            lastBg = 'red';
        }
        setColor(lastid, lastBg);
        if (data != lastData) {
            $.get('update.php',
                  {team: lastTeam,
                   event: lastEvent,
                   data: data});
        }
    }
    var id = getId(sTeam, sEvent);
    $(id).focus();
    setTimeout(function() { $(id)[0].select(); }, 5);
    lastTeam = sTeam;
    lastEvent = sEvent;
    lastBg = getColor(id);
    lastData = $(id).val();
    setColor(id, 'cyan');
}

$(document).ready(function () {
    var updateEvent = 0;

    setInterval(function () {
        $.getJSON('update.php',
                  {event: updateEvent},
                  function(response) {
                      response.points.forEach(function(item, index) {
                          setData(index, response.event, item);
                      });
                  });
        ++updateEvent;
        if (updateEvent >= maxEvent) {
            updateEvent = 0;
        }
    }, 500);

    setCursor();

    $('.filler').attr('height', scrollBarWidth());

    $('.box').on('click', function (event) {
        event.stopPropagation();
        var id = /t(\d+)e(\d+)/.exec(event.target.id);
        sTeam = id[1];
        sEvent = id[2];
        setCursor();
    });

    $('.box').on('keydown', function (event) {
        var move = 0;
        if (event.which == 37 /* left */) {
            --sEvent;
            if (sEvent < 0) {
                sEvent = 0;
            }
            move = 1;
        }
        else if (event.which == 39 /* right */) {
            ++sEvent;
            if (sEvent >= maxEvent) {
                sEvent = maxEvent - 1;
            }
            move = 1;
        }
        else if (event.which == 40 /* down */) {
            ++sTeam;
            if (sTeam >= maxTeam) {
                sTeam = maxTeam - 1;
            }
            move = 1;
        }
        else if (event.which == 38 /* up */) {
            --sTeam;
            if (sTeam < 0) {
                sTeam = 0;
            }
            move = 1;
        }
        if (move) {
            event.stopPropagation();
            setCursor();
        }
    });
});
</script>
</head>

<div id=team></div><br><br>
<div id=event></div><br><br>
<div id=status></div>

<div>
<div style="display:inline-block; vertical-align: bottom; max-width: 150px; overflow:hidden; width:15%">
<table cellpadding=2>

EOT;

foreach ($GLOBALS['teams'] as $t => $v) {
    $ts = $v[0] . ': ' . $t;
    echo "<tr><td><input readonly type=text value=\"$ts\"></td></tr>";
}
echo '<tr><td class=filler></td></tr>';

echo '</table>';
echo '</div>';

echo '<div style="display:inline-block; overflow:auto; width:85%">';
echo '<table cellpadding=2>';

echo '<tr>';
$i = 0;
foreach ($GLOBALS['events'] as $e => $ename) {
    echo "<td>$e</td>\n";
    ++$i;
}
echo '</tr>';

$tnr = 0;
foreach ($GLOBALS['teams'] as $t => $v) {
    $enr = 0;
    foreach ($GLOBALS['events'] as $e => $ename) {
        $p = getPoints($tnr, $enr);
        $color = 'white';
        if (is_null($p)) {
            $p = '';
            $color = 'red';
        }
        echo "<td><input class=\"box ${color}\" id=t${tnr}e${enr} type=text maxlength=4 size=3 value=$p></td>\n";
        ++$enr;
    }
    echo "</tr>";
    ++$tnr;
}

echo '</table>';
echo '</div>';
echo '</div>';
echo '</html>';

?>
