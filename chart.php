<?php

require_once 'rebus_util.php';
require_once 'rebus_settings.php';

function norm($nr, $max)
{
    if ($max == 0) {
        $nr = 0;
        $max = 1;
    }
    $barwidth = 500;
    $norm = abs(round($barwidth * ($nr / $max)));

    if ($norm == 0) {
        $norm = 1;
    }

    return $norm;
}

function bar($nr, $max, $color)
{
    $norm = norm($nr, $max);
    $barheight = 10;
    $p = PICTURE_URL;
    echo "<img src=$p$color.gif alt=\"$nr\" width=$norm height=$barheight border=0>";
}

function barLine($color)
{
    $barheight = 10;
    $p = PICTURE_URL;
    echo "<img src=$p$color.gif alt=\"\" width=1 height=$barheight border=0>";
}

function chartRow($teaminfo, $max, $nr, $nr2 = null, $comp = null)
{
    $flair = "";
    preg_match_all('/<([^>]*)>/', $teaminfo['flair'], $matches);
    foreach ($matches[1] as $f) {
        if (checkPic($f)) {
            $flair = $flair . "<img src=\"$f\" alt=\"\">";
        }
    }

    $name = $teaminfo['name'] . $flair;
    $teamnr = $teaminfo['number'];

    echo "<td align=right>$teamnr</td>";
    $p = PICTURE_URL;
    if (!is_null($comp)) {
        if ($comp > 0) {
            echo "<td><img src=\"${p}red_arrow.png\" alt=\"\"></td>";
        }
        else if ($comp < 0) {
            echo "<td><img src=\"${p}green_arrow.png\" alt=\"\"></td>";
        }
        else {
            echo "<td>&nbsp;</td>";
        }
    }
    echo "<td align=left>$name</td>";
    echo "<td>&nbsp;&nbsp;</td>";
    $snr = $nr;
    if (is_null($snr)) {
        $snr = '-';
    }
    if (is_null($nr2)) {
        echo "<td align=right>$snr</td>";
        echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>";
        if ($nr >= 0) {
            echo "<td>&nbsp;</td>\n";
            echo "<td align=left>", bar($nr, $max, 1), "</td>\n";
        }
        else {
            echo "<td align=right>", bar($nr, $max, 1), "</td>\n";
            echo "<td>&nbsp;</td>\n";
        }
    }
    else {
        echo "<td align=right>$nr+$nr2</td>";
        echo "<td>&nbsp;&nbsp;&nbsp;</td>";
        echo "<td>", bar($nr, $max, 1), barLine(2), bar($nr2, $max, 4), "</td>\n";
    }
}

function getPoint($d)
{
    if (is_array($d)) {
        return array_sum($d);
    }
    elseif (is_null($d)) {
        return 0;
    }
    else {
        return $d;
    }
}

function pointCmp($a, $b)
{
    $ap = getPoint($a);
    $bp = getPoint($b);
    if ($ap == $bp) {
        return 0;
    }
    return ($ap < $bp) ? -1 : 1;
}

function chart($data, $sort = 0, $prev_data = null)
{
    $json = array();
    foreach ($data as $teamnr => $d) {
        $info = getTeamInfo($teamnr);
        $info['points'] = getPoint($d);
        $info['index'] = $teamnr;

        preg_match_all('/<([^>]*)>/', $info['flair'], $matches);
        foreach ($matches[1] as $f) {
            if (checkPic($f)) {
                $info['flair_img'] = $f;
            }
        }

        $json[$teamnr] = $info;
    }

    $prevjson = array();
    if (!is_null($prev_data)) {
        foreach ($prev_data as $teamnr => $d) {
            $info = getTeamInfo($teamnr);
            $info['points'] = getPoint($d);
            $info['index'] = $teamnr;

            preg_match_all('/<([^>]*)>/', $info['flair'], $matches);
            foreach ($matches[1] as $f) {
                if (checkPic($f)) {
                    $info['flair_img'] = $f;
                }
            }
            $prevjson[$teamnr] = $info;
        }
    }

    echo "<svg class='chart'></svg>\n";
    echo "<script>\n";
    echo "var data = " . json_encode($json) . ";\n";
    echo "var prevdata = " . json_encode($prevjson) . ";\n";
    echo "var sort = " . $sort . ";\n";
    echo <<<EOT

var graphWidth = 500;
var barHeight = 30;
var textWidth = 300;
var width = graphWidth + textWidth;

function update(_data) {
var x = d3.scale.linear()
    .domain([Math.min(0, d3.min(_data, function(d) { return d.points; })),
             d3.max(_data, function(d) { return d.points; })])
    .range([0, graphWidth]);

var chart = d3.select(".chart")
    .attr("width", width)
    .attr("height", barHeight * _data.length);

var row = chart.selectAll("g")
    .data(_data);

row.enter()
  .append("g")
    .attr("transform", function(d, i) { return "translate(0, " + i * barHeight + ")"; });

row.exit().remove();

if (sort) {
  row.sort(function(a, b) { return d3.ascending(a.points, b.points); })
    .transition()
      .duration(function(d, i) { return 0; })
      .delay(function(d, i) { return 0 * 100; })
      .attr("transform", function(d, i) { return "translate(0, " + i * barHeight + ")"; });
}

var desc = row.append("g");
var graph = row.append("g")
  .attr("transform", "translate(" + textWidth + ",0)");

graph.append("rect")
    .attr("x", x(0))
    .attr("width", 0)
    .attr("height", barHeight - 1)
  .transition()
    .duration(500)
    .attr("x", function(d) {
      if (d.points < 0) {
        return x(d.points);
      }
      else {
        return x(0);
      }
    })
    .attr("width", function(d) { return Math.abs(x(d.points) - x(0)); })

var number_text = graph.append("text")
  .style("fill-opacity", 0.0)
  .attr("x", x(0))
  .attr("y", barHeight / 2)
  .attr("dy", ".35em")
  .attr("fill", "white")
  .attr("text-anchor", function(d) { return d.points < 0 ? "start" : "end"; })
  .text(function(d) { return d.points == 0 ? "" : d.points; });

number_text.transition()
  .duration(500)
  .style("fill-opacity", 1.0)
  .attr("x", function(d) { return x(d.points) - 3 * Math.sign(d.points); })

desc.append("text")
  .attr("x", 0)
  .attr("y", barHeight / 2)
  .attr("dy", ".35em")
  .text(function(d) { return d.number; });

desc.append("image")
  .attr("x", 30)
  .attr("y", 0)
  .attr("width", 20)
  .attr("height", barHeight)
  .attr("dy", ".35em")
  .attr("xlink:href", function(d) { return d.flair_img; });

desc.append("text")
  .attr("x", 60)
  .attr("y", barHeight / 2)
  .attr("dy", ".35em")
  .text(function(d) { return d.name; });
}
update(data);

//if (prevdata.length > 0)
//setTimeout(function () { update(prevdata); }, 1000);

</script>
EOT;
}

function oldchart($data, $sort = 0, $prev_data = null)
{
    if ($sort) {
        uasort($data, "pointCmp");
    }

    $comp = null;
    if (!is_null($prev_data)) {
        if ($sort) {
            uasort($prev_data, "pointCmp");
        }

        $p = 0;
        foreach ($data as $teamnr => $d) {
            $comp[$teamnr] = $p++;
        }
        $p = 0;
        foreach ($prev_data as $teamnr => $d) {
            $comp[$teamnr] -= $p++;
        }
    }

    $max = 0;
    $min = 0;
    foreach ($data as $teamnr => $d) {
        $p = getPoint($d);
        if ($p < $min) {
            $min = $p;
        }
        if ($p > $max) {
            $max = $p;
        }
    }
    $len = $max - $min;

    echo "<table border=0 cellspacing=0 cellpadding=2>\n";
    $i = 0;
    $c = null;
    foreach ($data as $teamnr => $d) {
        ++$i;
        if ($i & 1) {
            $class = "tr_odd";
        }
        else {
            $class = "tr_even";
        }
        echo "<tr class=$class>\n";
        if (!is_null($comp)) {
            $c = $comp[$teamnr];
        }
        if (is_array($d)) {
            chartRow(getTeamInfo($teamnr), $len, $d[0], $d[1], $c);
        }
        else {
            chartRow(getTeamInfo($teamnr), $len, $d, null, $c);
        }
        echo "</tr>\n";
    }
    echo "</table>\n";
}

?>
