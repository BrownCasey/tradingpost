<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<title>The Bazaar</title>
    </meta>
    <script src="https://www.google.com/jsapi"></script>
</head>
<body>
	<form action="index.php" method="get">
	<input type="text" name="searchbox" placeholder="Search items by name">
	<input type="submit" value="submit"/>
	<button onClick="showData()">Click Me</button>
	</form>
	<div id="table_div"></div>
	<pre id="main">
	<?php
	require_once("includes/common.php");
	$myRow = "hello";
	if(isset($_GET["searchbox"])){
	$itemQuery = $_GET["searchbox"];
// Slow. Times out.
/*	$sql = "SELECT items.id, items.name, time, buy, sell 
		FROM items 
		LEFT JOIN prices 
		ON items.id = prices.id 
		WHERE items.name LIKE '%$itemQuery%'"; */
// Still slow. Times out.
/*	$sql = "SELECT id, name 
		FROM items 
		WHERE name LIKE '%$itemQuery%' 
		GROUP BY id"; */
// Still slow.
/*	$sql = "SELECT id, name 
		FROM items 
		WHERE id = '68' OR id = '69' OR id = '132'"; */
	$sql = "SELECT items.id, items.name, time, buy, sell
		FROM items 
		LEFT JOIN prices 
		ON items.id = prices.id
		WHERE items.name LIKE '%$itemQuery%'";
	$result = mysql_query($sql);
	$stack = array();
		while($row = mysql_fetch_array($result)){
			$array = array(
			$row[1],
			$row[3],
			$row[4],
			$row[2],
			);
			array_push($stack, $array);
		}
	echo "<br><br>";
	$stack = (json_encode($stack));
	echo "<div id='chartData' style='display: none;'>";
	echo $stack;
	echo "</div>";
// Slow caused by infinite loop? Methinks yes . . .
//		while($result){
//			$row = mysql_fetch_array($result);
//			print_r($row);
//		}
	}
	else {
		$sql = "SELECT * FROM items";
		$result = mysql_query($sql);
		while($row = mysql_fetch_array($result)){
			print $row['id'] . "\t";
			print $row['name'] . "\n";
		}
	}
	?>
	</pre>
<script src="script.js"></script>
</body>
</html>
