<script src="https://www.google.com/jsapi"></script>
<script>
	google.load("visualization", "1", {packages:["corechart"]});
	google.setOnLoadCallback(drawChart);

	function drawChart() {
		var data = google.visualization.arrayToDataTable(<?php echo $stack ?>);

		var options = {
			title: 'Trading Post Prices for <?php echo $itemName ?>'
		};

		var chart = new google.visualization.LineChart(document.getElementById('table_div'));

		chart.draw(data, options);
	}
</script>
