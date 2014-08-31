	// come back and investigate google.visualization.arrayToDataTable()
	google.load("visualization", "1", {packages:["table"]});
	google.setOnLoadCallback(drawTable);

	function drawTable(chartData) {
	    var data = new google.visualization.DataTable();
	    data.addColumn('string', 'Item');
	    data.addColumn('string', 'Buy');
	    data.addColumn('string', 'Sell');
	    data.addColumn('string', 'Timestamp');
	    data.addRows(chartData);

	    var table = new google.visualization.Table(document.getElementById('table_div'));

	    table.draw(data, {showRowNumber: true});
	}

	var chartData = document.getElementById("chartData").innerHTML;
	function showData(){
		document.getElementById("main").innerHTML = chartData;
	}
	
