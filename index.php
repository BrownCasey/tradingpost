<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<title>The Bazaar</title>
    </meta>
    <script src="https://www.google.com/jsapi"></script>
    <script>
	// come back and investigate google.visualization.arrayToDataTable()
	google.load("visualization", "1", {packages:["table"]});
	google.setOnLoadCallback(drawTable);

	function drawTable() {
	    var data = new google.visualization.DataTable();
	    data.addColumn('string', 'Item');
	    data.addColumn('number', 'Buy');
	    data.addColumn('number', 'Sell');
	    data.addColumn('number', 'Timestamp');
	    data.addRows([
		['Iron', 10, 15, 2014082500],
		['Iron', 11, 16, 2014082506],
		['Wood', 5, 8, 2014082500],
		['Wood', 5, 7, 2014082506]
	    ]);

	    var table = new google.visualization.Table(document.getElementById('table_div'));

	    table.draw(data, {showRowNumber: true});
	}
    </script>
</head>
<body>
	<form action="index.php" method="get">
	<input type="text" name="searchbox" placeholder="Search items by name">
	<input type="submit" value="submit"/>
	</form>
	<div id="table_div"></div>
	<pre>
	<?php
	require_once("includes/common.php");
	
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
		while($row = mysql_fetch_array($result)){
			$array = array(
			$row[1],
			$row[3],
			$row[4],
			$row[2],
			);
			echo json_encode($array);
			print_r($row);
		}
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
</body>
</html>
