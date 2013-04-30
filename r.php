<?php

require_once 'rebus.php';
require_once 'db.php';

echo <<<EOT
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<script language="javascript" type="text/javascript" src="mootools.js"></script>
<script type="text/javascript">

var sEvent = 0;
var sTeam = 0;
var lastData = '';

function getId(team, event) {
  return 't' + team + 'e' + event;
}

function setData(team, event, data) {
    var id = getId(team, event);
    var c;

    if (data == null) {
        c = 'red';
        $(id).set('value', '');
    }
    else if ($(id).get('value') != data) {
        c = 'green';
        if (team == sTeam && event == sEvent) {
            // Dont overwrite selected data
            if (data != lastData) {
                $('status').set('html',
                                '<font color=red>WARNING: DB updated with value '
                                + data + '</font>');
            }
        }
        else {
            $(id).set('value', data);
        }
    }
    else if (team == sTeam && event == sEvent) {
        c = 'cyan';
    }
    else {
        c = 'white';
    }

    $(id).setStyle('background-color', c);
}

var updateRequest = new Request.JSON({
    url: 'update.php',
    method: 'get',
    onSuccess: function(response) {
        response.points.each(function(item, index) {
            setData(index, response.event, item);
        });
    }
});


window.addEvent('domready', function() {
    var lastBg = '';
    var lastEvent = 0;
    var lastTeam = 0;

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

    var updateEvent = 0;

    this.setInterval(function () {
        updateRequest.send('event=' + updateEvent);
        ++updateEvent;
        if (updateEvent >= maxEvent) {
            updateEvent = 0;
        }
    }, 1000);

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
        $('status').set('html', teams[sTeam] + '<br><br>' + events[sEvent] + '<br><br>' + i + max);

        if (lastBg != '') {
            var lastid = getId(lastTeam, lastEvent);
            var data = $(lastid).get('value');
            if (data != '' && lastBg == 'red') {
                lastBg = 'white';
            }
            else if (data == '') {
                lastBg = 'red';
            }
            $(lastid).setStyle('background-color', lastBg);
            if (data != lastData) {
                var setRequest = new Request.JSON({
                    url: 'update.php',
                    method: 'get'
                });
                setRequest.send('team=' + lastTeam + '&event=' + lastEvent + '&data=' + data);
            }
        }
        var id = getId(sTeam, sEvent);
        $(id).focus();
        $(id).select();
        lastTeam = sTeam;
        lastEvent = sEvent;
        lastBg = $(id).getStyle('background-color');
        lastData = $(id).get('value');
        $(id).setStyle('background-color', 'cyan');
    }

    setCursor();

    $$('.box').addEvent('click', function(event) {
        event.stop();
        var id = /t(\d+)e(\d+)/.exec(this.get('id'));
        sTeam = id[1];
        sEvent = id[2];
        setCursor();
    });

    $$('.box').addEvent('keydown', function(event) {
        var move = 0;
        if (event.key == 'left') {
            --sEvent;
            if (sEvent < 0) {
                sEvent = 0;
            }
            move = 1;
        }
        else if (event.key == 'right') {
            ++sEvent;
            if (sEvent >= maxEvent) {
                sEvent = maxEvent - 1;
            }
            move = 1;
        }
        else if (event.key == 'down') {
            ++sTeam;
            if (sTeam >= maxTeam) {
                sTeam = maxTeam - 1;
            }
            move = 1;
        }
        else if (event.key == 'up') {
            --sTeam;
            if (sTeam < 0) {
                sTeam = 0;
            }
            move = 1;
        }
        if (move) {
            event.stop();
            setCursor();
        }
    });
});
</script>
</head>
EOT;

echo '<div id=status></div>';

echo '<table width=1100>';

echo '<tr><td>';
echo '<table cellpadding=2 width=100>';
echo '<tr><td>&nbsp;</td></tr>';

foreach ($GLOBALS['teams'] as $t => $v) {
    $ts = $v[0] . ': ' . $t;
    echo "<tr><td><input readonly type=text value=\"$ts\"></td></tr>";
}

echo '</table>';
echo '</td>';

echo '<td>';
echo '<div style="overflow:auto; width:1000px">';
echo '<table cellpadding=2>';
echo '<form action="foo.php" method=post>';

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
        $style = '';
        if (is_null($p)) {
            $p = '';
            $style = 'style="background-color:red"';
        }
        echo "<td><input class=box id=t${tnr}e${enr} type=text maxlength=6 size=3 name=e$enr value=\"$p\" $style></td>\n";
        ++$enr;
    }
    echo "</tr>";
    ++$tnr;
}

echo '</form>';
echo '</table>';
echo '</div>';
echo '</td></tr>';
echo '</table>';
echo '</html>';

?>
