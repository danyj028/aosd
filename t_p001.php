<?php

for($k=1;$k<=2;$k++)
{
          print <<< endprint

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<title>Test Print</title>
		<meta name="author" content="root" >
		<meta name="generator" content="screem 0.16.1" >
		<meta name="description" content="" >
		<meta name="keywords" content="" >
		<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" >
		<meta http-equiv="Content-Script-Type" content="text/javascript" >
		<meta http-equiv="Content-Style-Type" content="text/css" >
	</head>
	<body>
	This is a line of text	
	</body>
</html>

endprint;
}


$w_today = getdate();

$w_month = (int)  $w_today["month"];
$w_year = (int) $w_today["year"];
print "<br>".$w_today["wday"];
print "<br>".$w_today["mday"];
print "<br>".$w_month;
print "<br>".$w_year."<br>";

$w_fday = mktime(0,0,0, $w_month, 1, $w_year);

$w_first_month_day = getdate($w_fday);

print("<br>".$w_first_month_day["weekday"]."day")

?>


