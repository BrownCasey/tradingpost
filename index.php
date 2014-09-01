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
	</form>
	<div id="table_div" style="width: 900px; max-height: 500px"></div>
	<pre id="main">
	<?php
	require_once("includes/common.php");
	if(isset($_GET["id"])){
		$itemId = $_GET["id"];
		$sql = "SELECT items.id, items.name, time, buy, sell
			FROM items 
			LEFT JOIN prices 
			ON items.id = prices.id
			WHERE items.id = '$itemId'
			ORDER BY time";
		$result = mysql_query($sql);
		$stack = array(['Time', 'Buy Price', 'Sell Price']);
		$row = mysql_fetch_array($result);
		while($row = mysql_fetch_array($result)){
			$itemName = $row[1];
			$array = array(
				$row[2],
				$row[3],
				$row[4]
			);
			array_push($stack, $array);
		}
		$stack = json_encode($stack);
		$stack = str_replace('"', '', $stack);
		$stack = str_replace('Time', '"Time"', $stack);
		$stack = str_replace('Buy Price', '"Buy Price"', $stack);
		$stack = str_replace('Sell Price', '"Sell Price"', $stack);
		print_r($stack);
		include "chart.php";
	}
	elseif(isset($_GET["searchbox"])){
		$itemQuery = $_GET["searchbox"];
		$sql = "SELECT items.id, items.name, time, buy, sell
			FROM items 
			LEFT JOIN prices 
			ON items.id = prices.id
			WHERE items.name LIKE '%$itemQuery%'
			GROUP BY items.id";
		$result = mysql_query($sql);
		$stack = array();
		while($row = mysql_fetch_array($result)){
			$array = array(
			"<a href='index.php?id=" . $row[0] . "'>" . $row[1] . "</a>",
			$row[3],
			$row[4],
			$row[2],
			);
			array_push($stack, $array);
		}
		echo "<br><br>";
		$stack = (json_encode($stack));
		include "script.php";
	}
// For learning purposes:
// Slow query caused by infinite loop? Methinks yes . . .
//		while($result){
//			$row = mysql_fetch_array($result);
//			print_r($row);
//		}
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
<?php // include 'script.php';
?>
</body>
</html>
