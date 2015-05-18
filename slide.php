<?php

require_once 'chart.php';
require_once 'db.php';
require_once 'rebus_util.php';
require_once 'rebus.php';

class Slide
{
    var $title;

    function getTitle() {
        return $this->title;
    }

    function getLines() {
        return 0;
    }

    function printHtml() {
    }
}

class PictureSlide extends Slide
{
    var $picture;

    function PictureSlide($t, $p) {
        $size = getimagesize($p);

        checkPic($p);
        $this->title = $t;
        $this->picture = $p;
        $this->attr = "height=400";

        $width = $size[0];
        $height = $size[1];
        if ($width && $height) {
            $scale = 400.0 / $height;
            $width *= $scale;
            if ($width > 800) {
                $this->attr = "width=800";
            }
        }
    }

    function printHtml() {
        echo "<br><img src=\"$this->picture\" $this->attr>\n";
    }
}

class EventSlide extends Slide
{
    var $event;
    var $event2;
    var $max;

    function EventSlide($t, $e, $e2 = null, $max = 0, $sort = 0) {
        $this->title = $t;
        $this->event = $e;
        $this->event2 = $e2;
        $this->max = $max;
        $this->sort = $sort;
    }

    function printHtml() {
        if (is_null($this->event2)) {
            chart(getEventPoints(getEventNumber($this->event)), $this->sort, null, $this->max);
        }
        else {
            chart(getEventPoints(getEventNumber($this->event),
                                 getEventNumber($this->event2)), $this->sort, null, $this->max);
        }
    }
}

class SumSlide extends Slide
{
    var $sum;

    function SumSlide($t, $s) {
        $this->title = $t;
        if (!is_array($s)) {
            $this->sum = array($s);
        }
        else {
            $this->sum = $s;
        }
    }

    function printHtml() {
        $data = array();

        foreach ($this->sum as $e) {
            if ($e != '*sum*') {
                foreach (getPartEvents($e) as $e1) {
                    updateEventPoints($data, getEventNumber($e1));
                }
            }
        }
        chart($data, 1);
    }
}

class SumCompSlide extends Slide
{
    var $sum;

    function SumCompSlide($t, $s) {
        $this->title = $t;
        if (!is_array($s)) {
            $this->sum = array($s);
        }
        else {
            $this->sum = $s;
        }
    }

    function printHtml() {
        $data = array();
        $first = 1;
        $prev_data = array();

        foreach ($this->sum as $e) {
            if ($e != '*sumcomp*') {
                foreach (getPartEvents($e) as $e1) {
                    updateEventPoints($data, getEventNumber($e1));
                    if ($first) {
                        updateEventPoints($prev_data, getEventNumber($e1));
                    }
                }
                $first = 0;
            }
        }

        chart($data, 1, $prev_data);
    }
}

class TitleSlide extends Slide
{
    function TitleSlide($t) {
        $this->title = $t;
    }
}

class SolutionSlide extends Slide
{
    /* Rebusformat:
    \bild <bild>
    \rebus <rebus start>
    \ort <rebussvar>
    \upphovsman <signatur>
    \av <signatur>
    \op <rebus operation>
    <text>
    */

    function rebusParse($text, &$break_line) {
        $break_line = "<br>";
        $c = 0;
        $op_font_size = "+2";
        $text = preg_replace('/\\\\op ([^\\\\]*)/i',
                             "<div class=rebusop>$1</div>", $text, -1, $c);
        if ($c > 0) {
            $break_line = "";
        }
        $p = PICTURE_URL;
        $text = preg_replace('/\\\\bild (\S+)/i',
                             "<center><img src=\"$p/$1\" width=\"100%\" alt=\"$1\"></center>", $text, -1, $c);
        if ($c > 0) {
            $break_line = "";
        }

        $text = preg_replace('/\\\\rebus ([^\\\\]+)/i', '<span class=originalrebus>$1</span>', $text);
        $text = preg_replace('/\\\\ort (.+)/i', '<div class=rebusortDiv><span class=rebusort>$1</span></div>', $text);
        $text = preg_replace('/\\\\(?:av|upphovsman) (.+)/i', '<span class=rebusmaker>($1)</span>', $text);
        $text = preg_replace('/\\\w* /', '', $text);

        return $text;
    }

    var $file;

    function SolutionSlide($type, $nr) {
        $f = $type . $nr;
        $this->file = file(DATAROOT . '/' . NAME . '/' . $f . '.txt');
        if ($type == 'R') {
            $this->title = "Rebus " . $nr;
        }
        elseif ($type == 'H') {
            $this->title = "Hjälp " . $nr;
        }
        elseif ($type == 'S') {
            $this->title = "Stjälp " . $nr;
        }
        else {
            echo "ERROR: Bad rebus type '$type'<br>";
        }
    }

    function getLines() {
        return count($this->file);
    }

    function printHtml() {
        echo "<table class=rebustable>\n";
        echo "<tr><td align=left valign=middle><div class=rebustext>\n";

        $i = 0;
        $break = "";
        foreach ($this->file as $f) {
            $opacity = ($i == 0) ? 1 : 0;
            if ($GLOBALS['rebus_split'] == 0) {
                echo "<div class=rebus$i>";
            }
            else {
                echo "<div class=rebus$i style=\"opacity:$opacity\">";
            }
            echo $this->rebusParse($f, $break);
            echo "$break</div>\n";
            ++$i;
        }

        echo "</div></td></tr></table>\n";
    }
}

?>
