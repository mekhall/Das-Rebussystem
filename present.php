<?php

require_once 'rebus.php';
require_once 'present_setup.php';

$nr = array_key_exists('nr', $_GET) ? $_GET['nr'] : 0;
if ($nr >= count($actions)) {
   $nr = count($actions) - 1;
}
$setline = array_key_exists('setline', $_GET) ? $_GET['setline'] : -1;
$check = array_key_exists('check', $_GET) ? $_GET['check'] : 0;
$dec = $nr <= 0 ? "nr=0" : "nr=".($nr - 1);
$action = $actions[$nr];
$lines = $action->getLines();

if (array_key_exists('static', $GLOBALS) == 0 && $check == 0) {
  file_put_contents("current", $nr);
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-type" content="text/html;charset=iso-8859-1">
<title>Rebusrally <?php echo NAME ?></title>
<link rel="stylesheet" type="text/css" href="style.css">
<script src="mootools.js" type="text/javascript"></script>
<script type="text/javascript">
var maxLine = 0;
var line = 0;
var check = 0;

<?php
    if ($check) {
?>
check = 1;

var updateRequest = new Request.JSON({
    url: 'check.php',
    method: 'get',
    onSuccess: function(response) {
        var parts = response[0].split(':');
        var setline = "";
        if (parts.length > 1) {
          setline = "&setline=" + parts[1];
        }

        if (parts[0] != <?php echo $nr ?>) {
            window.location = "present.php?check=1&nr=" + parts[0];
            return;
        }
        if (parts[1] != line) {
            window.location = "present.php?check=1&nr=" + parts[0] + setline;
        }
    }
});
<?php
    }
?>

var lineRequest = new Request.JSON({
    url: 'currentline.php',
    method: 'get'
});


window.addEvent('domready', function() {
    addEvent('keydown', function(event) {
        if (event.key == 'left' || event.key == '!') {
            window.location = "present.php?<?php echo $dec ?>";
        }
        else if (event.key == 'right' || event.key == 'space' ||
                 event.key == '"') {
            next(<?php echo "$nr, $lines"; ?>);
        }
    });

    $$('tr.header').addEvent('click', function(event) {
        next(<?php echo "$nr, $lines"; ?>);
    });

<?php
    if ($setline > 0) {
        echo "for (var i = 0; i < $setline; i++) { next($nr, $lines); }";
    }

    if ($check) {
?>
    this.setInterval(function () {
        updateRequest.send();
    }, 1000);
<?php
    }
?>
});

function next(nr, maxLine)
{
<?php
    if ($rebus_split == 0) {
        echo "    maxLine = 0;";
    }
?>

    if (maxLine > 0) {
        line += 1;
        if (line >= maxLine) {
            window.location = "present.php?nr=" + (nr + 1);
        }
        else {
            $$('div.rebus' + line).<?php echo $GLOBALS['rebus_tween'] ? 'tween' : 'setStyle' ?>('opacity', 1);
            if (!check) {
              lineRequest.send('nr=' + nr + '&line=' + line);
            }
        }
    }
    else {
        line = 0;
        window.location = "present.php?nr=" + (nr + 1);
    }
}
</script>
</head>
<body>
<table border=0 cellpadding=0 cellspacing=0 width="100%">

<tr class=header>
  <td class=header align=left>
    <a class=rub1><?php echo $action->getTitle(); ?></a>&nbsp;
  </td>
<?php
  if ($GLOBALS['display_logo']) {
    $p = "logga.gif";
    if (checkPic($p)) {
      echo "<td class=header align=right valign=top><img src=\"$p\" class=logo alt=logo></td>\n";
    }
  }
?>
</tr>

<tr>
  <td colspan=2 class=headerline></td>
</tr>

<?php
    if ($index_links) {
?>

<tr>
  <td align=center>
    <table width="90%" border=0>
      <tr>
        <td align=right>
          <a class=rub3 href=present.php?<?php echo $dec ?> >föregående</a>
          <a> | </a>
          <a href="#" onclick="next(<?php echo "$nr, $lines"; ?>)" class=rub3>nästa</a>
        </td>
      </tr>
    </table>
  </td>
</tr>

<?php
    }

    if ($action->getMiddle()) {
        echo '<tr style="height:450px"><td colspan=2 align=center valign=top><table style="height:100%"><tr><td valign=middle>';
    }
    else {
        echo '<tr style="height:450px"><td colspan=2 align=center valign=top><table cellpadding=10><tr><td>';
    }

    echo $action->printHtml();

    echo '   </td></tr></table></td></tr>';

    if ($index_links) {
?>

<tr>
<td align=center>
<table width="90%" border=0>
  <tr>
    <td align=right>
      <a class=rub3 href=present.php?<?php echo $dec ?>>föregående</a>
      <a> | </a>
      <a href="#" onclick="next(<?php echo "$nr, $lines"; ?>)" class=rub3>nästa</a>
    </td>
  </tr>
</table>
</td>
</tr>

<tr>
<td align=center>
<table width="90%">
  <tr>
    <td>
<?php
        for ($o = 0; $o < count($actions); ++$o) {
            if ($o == $nr) {
                echo "<a class=rub5 href=present.php?nr=$o>$o</a>\n";
            } else {
                echo "<a class=rub4 href=present.php?nr=$o>$o</a>\n";
            }
        }
?>

    </td>
  </tr>
</table>
</td>
</tr>

<?php
    }
?>

</table>
</body>
</html>
