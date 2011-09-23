<?php
require_once 'rebus.php';
require_once 'present_setup.php';

$nr = array_key_exists('nr', $_GET) ? $_GET['nr'] : 0;
if ($nr >= count($actions)) {
   $nr = count($actions) - 1;
}
$check = array_key_exists('check', $_GET) ? $_GET['check'] : 0;
$dec = $nr <= 0 ? "nr=0" : "nr=".($nr - 1);
$action = $actions[$nr];
$lines = $action->getLines();

if ($GLOBALS['static'] == 0 && $check == 0) {
   file_put_contents("current", $nr);
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css"></link>
<script src="mootools.js" type="text/javascript"></script>
<script type="text/javascript">
var maxLine = 0;
var line = 0;

<?php
    if ($check) {
?>
var updateRequest = new Request.JSON({
    url: 'check.php',
    method: 'get',
    onSuccess: function(response) {
        if (response != <?php echo $nr ?>) {
            window.location = "present.php?check=1&nr=" + response;
	}
    }
});
<?php
    }
?>

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
	    $$('div.rebus' + line).tween('opacity', 1);
	}
    }
    else {
	line = 0;
	window.location = "present.php?nr=" + (nr + 1);
    }
}
</script>
</head>
<body marginheight=0 marginwidth=0 rightmargin=0 leftmargin=0 topmargin=0>
<table border=0 cellpadding=0 cellspacing=0 width=100%>

<tr class=header>
  <td class=header>
    <a class=rub1>&nbsp;&nbsp;&nbsp;<?php echo $action->getTitle(); ?></a>&nbsp;
  </td>
<?php 
  if ($display_logo) {
    $p = PICTURE_URL;
    echo "<td class=header><img src=\"$p/tae.png\" width=100% height=80%></td>";
  }
?>
</tr>

<tr height=1>
  <td colspan=2 class=headerline></td>
</tr>

<?php
    if ($index_links) {
?>

<tr>
  <td align=center>
    <table width=90% border=0>
      <tr>
        <td align=right>
          <a class=rub3 href=present.php?<?php echo $dec ?> >föregående</a>
          <a> | </a>
          <a href=# onclick="next(<?php echo "$nr, $lines"; ?>)" class=rub3>nästa</a>
        </td>
      </tr>
    </table>
  </td>
</tr>

<?php
    }

    if ($action->getMiddle()) {
        echo '<tr height=450><td colspan=2 align=center valign=top><table height=\"100%\"><tr><td valign=middle>';
    }
    else {
        echo '<tr height=450><td colspan=2 align=center valign=top><table cellpadding=10><tr><td>';
    }

    echo $action->printHtml();

    echo '   </td></tr></table></td></tr>';

    if ($index_links) {
?>

<tr>
<td align=center>
<table width=90% border=0>
  <tr>
    <td align=right>
      <a class=rub3 href=present.php?<?php echo $dec ?>>föregående</a>
      <a> | </a>
      <a href=# onclick="next(<?php echo "$nr, $lines"; ?>)" class=rub3>nästa</a>
    </td>
  </tr>
</table>
</td>
</tr>

<tr>
<td align=center>
<table width=90%>
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
