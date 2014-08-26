<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<title>The Bazaar</title>
    </meta>
</head>
<body>
	<form action="index.php" method="get">
	<input type="text" name="searchbox" value="Search items by name">
	<input type="submit" value="submit"/>
	</form>
	<pre>
	<?php
	require_once("includes/common.php");
	
	if(isset($_GET["searchbox"])){
	$itemQuery = $_GET["searchbox"];
	$sql = "SELECT items.id, items.name, time, buy, sell 
		FROM items 
		LEFT JOIN prices 
		ON items.id = prices.id 
		WHERE items.name LIKE '%$itemQuery%'";
	$result = mysql_query($sql);
		while($result){
			$row = mysql_fetch_array($result);
			print_r($row);
		}
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
