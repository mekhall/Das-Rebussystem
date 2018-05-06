<?php
require_once 'rebus.php';
require_once 'db.php';
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Rebusrally status</title>
<link rel="stylesheet" type="text/css" href="<?php echo NAME ?>.css">
<script src="jquery-2.1.4.min.js"></script>
<script>
  function update() {
        $.getJSON('update.php',
                  {done_percentage: 1},
                  function(response) {
                      $('#percentage').text('Rättat ' + response[0] + '%');
                  });
  }
  update();
  setInterval(update, 15000);
</script>
<style>
.tt {
  color: white;
  font-family: "Verdana";
  font-size: 100px;
  text-align: center;
  margin-top: 100px;
  text-shadow: 4px 4px gray;
}
</style>
</head>
<body>
<div class=tt id=percentage></div>
</body>
</html>
