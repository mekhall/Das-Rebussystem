<?php

require_once 'rebus_util.php';
require_once 'rebus_settings.php';

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

function chart($data, $sort = 0, $prev_data = null, $max = 0)
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
    echo "var max = " . $max . ";\n";
    echo <<<JAVASCRIPT

var graphWidth = 500;
var barHeight = 30;
var textWidth = 300;
var width = graphWidth + textWidth;
var height = barHeight * data.length + 30;

function ƒ(name) {
  var v, params = Array.prototype.slice.call(arguments, 1);
  return function(o) {
    return (typeof(v = o[name]) === 'function' ? v.apply(o, params) : v );
  };
}

function sign(x) {
    return (x >= 0) ? 1 : -1;
}

function bar_width(p) {
    return Math.abs(x(p) - x(0));
}

function text_pos(p) {
    // Guess text_width, should use getBBox()
    var text_width = 8;
    if (p < 0) {
        text_width += 8;
    }
    if (Math.abs(p) >= 10) {
        text_width += 8;
    }
    // Try to move text outside of graph bars if it does not fit
    var off = p < 0 ? -5 : -3;
    offset = -3 * sign(p) * ((bar_width(p) > text_width) ? 1 : off);
    if (p >= 0) {
        offset -= text_width;
    }
    var maxRight = width - textWidth - 16;
    if (x(p) + offset > maxRight) {
        return maxRight;
    }
    return x(p) + offset;
}

var x = d3.scale.linear()
    .domain([Math.min(0, d3.min(data, ƒ('points')), d3.min(prevdata, ƒ('points')) || Infinity, (max < 0 ? max : Infinity)),
             Math.max(d3.max(data, ƒ('points')), d3.max(prevdata, ƒ('points')) || -Infinity, (max > 0 ? max : -Infinity))])
    .range([0, graphWidth]);

var chart = d3.select(".chart")
    .attr("width", width)
    .attr("height", height);

function update(data) {

  // JOIN
  var row = chart.selectAll("g.row").data(data, ƒ('index'));

  // UPDATE

  if (sort) {
    row.sort(function(a, b) { return d3.ascending(a.points, b.points); })
      .transition()
        .duration(function(d, i) { return 1000; })
        .delay(function(d, i) { return 1000 + i * 100; })
        .attr("transform", function(d, i) { return "translate(0, " + i * barHeight + ")"; });
  }
  else {
    row.attr("transform", function(d, i) { return "translate(0, " + i * barHeight + ")"; });
  }

  row.selectAll(".graph_bar").data(data, ƒ('index'))
    .transition()
      .duration(1000)
      .attr("x", function(d) { return d.points < 0 ? x(d.points) : x(0); })
      .attr("width", function(d) { return bar_width(d.points); });

  var xxx = row.selectAll("text.number").data(data, ƒ('index'));
    xxx.transition()
      .duration(1000)
      .tween("text", function(d) {
        var i = d3.interpolateRound(parseInt(this.textContent), d.points);
        return function(t) {
          var num = i(t);
          if (!isNaN(num)) {
            this.textContent = num;
          }
        }
      })
      .attr("x", function(d) { return text_pos(d.points); });
    
  // ENTER
  var bg_row = row.enter().append("g");
  bg_row.attr("transform", function(d, i) { return "translate(0, " + i * barHeight + ")"; });
  bg_row.append("rect")
   .attr("width", width)
   .attr("height", barHeight - 1)
   .attr("class", function(d, i) { return (i + 1) & 1 ? "graph_odd" : "graph_even" });

  var enter_row = row.enter().append("g").classed("row", true);
  if (sort) {
    enter_row.sort(function(a, b) { return d3.ascending(a.points, b.points); })
  }
  enter_row.attr("transform", function(d, i) { return "translate(0, " + i * barHeight + ")"; });
  
  enter_row
    .append("g")
      .classed("desc", true);

  var enter_graph =
    enter_row
      .append("g")
        .classed("graph", true)
        .attr("transform", "translate(" + textWidth + ",0)");

  enter_graph
    .append("rect")
      .attr("x", x(0))
      .attr("width", 0)
      .attr("height", barHeight - 1)
      .attr("class", "graph_bar")
    .transition()
      .duration(500)
      .attr("x", function(d) { return d.points < 0 ? x(d.points) : x(0); })
      .attr("width", function(d) { return bar_width(d.points); });

  enter_graph
    .append("text")
      .classed("number", true)
      .style("fill-opacity", 0.0)
      .attr("x", function(d) { return text_pos(0) + (d.points < 0 ? -16 : 0); })
      .attr("y", barHeight / 2)
      .attr("dy", ".35em")
      .attr("fill", "white")
      .text(function(d) { return d.points; })
    .transition()
      .duration(500)
      .style("fill-opacity", 1.0)
      .attr("x", function(d) { return text_pos(d.points); });

  if (max != 0) {
      chart.append("line")
          .attr("x1", textWidth + x(max))
          .attr("x2", textWidth + x(max))
          .attr("y1", 0)
          .attr("y2", height)
          .style({'stroke': 'green', 'stroke-width': 2});
      chart.append("text")
          .attr("x", textWidth + x(max) + (max > 0 ? -10 : 10))
          .attr("y", height - 10)
          .attr("text-anchor", max > 0 ? "end" : "start")
          .style("fill", "green")
          .text("Max: " + max);
  }


  // ENTER+UPDATE

  var desc = row.select(".desc");

  desc
    .append("text")
      .attr("x", 0)
      .attr("y", barHeight / 2)
      .attr("dy", ".35em")
      .text(ƒ('number'));

  desc
    .append("image")
      .attr("x", 30)
      .attr("y", 0)
      .attr("width", 20)
      .attr("height", barHeight)
      .attr("dy", ".35em")
      .attr("xlink:href", ƒ('flair_img'));

  desc
    .append("text")
      .attr("x", 60)
      .attr("y", barHeight / 2)
      .attr("dy", ".35em")
      .text(ƒ('name'));

  row.exit().remove();
}

if (prevdata.length > 0) {
  update(prevdata);
  setTimeout(function () { update(data); }, 1000);
}
else {
  update(data);
}

</script>
JAVASCRIPT;
}

?>
