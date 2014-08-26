<?php
//	date_default_timezone_set('UTC');
	print "<pre>";

	print "\$now = getdate()\n";
	$now = getdate();
	print_r($now);
	
	print "<strong>time()</strong><br><br>";
	print "<blockquote>" . time() . "</blockquote><br><br>";

	print "<strong>date('Y/m/d')</strong><br><br>";
	print "<blockquote>" . $today = date("Y/m/d") . "</blockquote><br><br>";

	print "<strong>date('Ymd')</strong><br><br>";
	print "<blockquote>" . date("Ymd") . "</blockquote><br><br>";

	print "<strong>12h date('Ymdh')</strong><br><br>";
	print "<blockquote>" . date("Ymdh") . "</blockquote><br><br>";

	print "<strong>12h gmdate('Ymdh')</strong><br><br>";
	print "<blockquote>" . gmdate("Ymdh") . "</blockquote><br><br>";

	print "<strong>24h date('YmdH')</strong><br><br>";
	print "<blockquote>" . date("YmdH") . "</blockquote><br><br>";

	print "<strong>24h gmdate('YmdH')</strong><br><br>";
	print "<blockquote>" . gmdate("YmdH") . "</blockquote><br><br>";

	print "</pre>";
?>
