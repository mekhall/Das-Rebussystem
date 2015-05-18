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
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Rebusrally <?php echo NAME ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo NAME ?>.css">
<script src="d3.v3.min.js"></script>
<script src="jquery-2.1.4.min.js"></script>
<script>
var maxLine = 0;
var line = 0;
var check = 0;

<?php
    if ($check) {
?>
check = 1;

<?php
    }
?>

$(function() {
    $('html').keydown(function(event) {
        if (event.which == 37 /* left */ || event.which == 49 /* ! */) {
            window.location = "present.php?<?php echo $dec ?>";
        }
        else if (event.which == 39 /* right */ || event.which == 32 ||
                 event.which == 50 /* " */) {
            next(<?php echo "$nr, $lines"; ?>);
        }
    });

    $('.header').click(function(event) {
        next(<?php echo "$nr, $lines"; ?>);
    });

<?php
    if ($setline > 0) {
        echo "for (var i = 0; i < $setline; i++) { next($nr, $lines); }";
    }

    if ($check) {
?>
    setInterval(function () {
        $.getJSON('check.php', function (response, status) {
            var parts = response[0].split(':');
            var setline = "";
            if (parts.length > 1) {
              setline = "&setline=" + parts[1];
            }

            if (parts[0] != <?php echo $nr ?>) {
                window.location = "present.php?check=1&nr=" + parts[0];
                return;
            }
            if (setline && parts[1] != line) {
                window.location = "present.php?check=1&nr=" + parts[0] + setline;
            }
        });
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
            $('div.rebus' + line).<?php echo $GLOBALS['rebus_tween'] ? 'animate({ opacity: 1 }, 1000)' : 'css("opacity", 1)' ?>;
            if (!check) {
                $.get('currentline.php', {nr: nr, line: line});
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

<div class=header>
  <div class=headertitle>
    <a class=rub1><?php echo $action->getTitle(); ?></a>
  </div>
  <?php
    if ($GLOBALS['display_logo']) {
      $p = "logga";
      if (checkPic($p)) {
  ?>
  <div class=headerlogo>
    <img src="<?php echo $p ?>" class=logo alt=logo>
  </div>
  <?php
      }
    }
  ?>
  </div>
</div>

<div class=headerline></div>

<?php
    if ($index_links) {
?>

<div class=indexlinks>
  <a class=rub3 href=present.php?<?php echo $dec ?> >föregående</a>
  <a> | </a>
  <a href="#" onclick="next(<?php echo "$nr, $lines"; ?>)" class=rub3>nästa</a>
</div>

<?php
    }

    echo '<div class=content>';
    echo $action->printHtml();
    echo '</div>';

    if ($index_links) {
?>

<div class=indexlinks>
  <a class=rub3 href=present.php?<?php echo $dec ?>>föregående</a>
  <a> | </a>
  <a href="#" onclick="next(<?php echo "$nr, $lines"; ?>)" class=rub3>nästa</a>
</div>

<div class=alllinks>
<?php
        for ($o = 0; $o < count($actions); ++$o) {
            if ($o == $nr) {
                echo "<a class=rub5 href=present.php?nr=$o>$o</a>\n";
            } else {
                echo "<a class=rub4 href=present.php?nr=$o>$o</a>\n";
            }
        }
?>
</div>

<?php
    }
?>

</body>
</html>
