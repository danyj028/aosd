<html>
	<head>
		<title>AOSD Search</title>
		<meta name="author" content="root" >
		<meta name="generator" content="Bluefish 2.2.3" >
		<meta name="description" content="" >
		<meta name="keywords" content="AOSD Management" >
		<meta http-equiv="content-type" content="text/html; charset=ISO-8859-1" >
		<meta http-equiv="Content-Script-Type" content="text/javascript" >
		<meta http-equiv="Content-Style-Type" content="text/css" >
		<link rel="stylesheet" href="elt_css/elt_01.css" type="text/css">
		
	</head>
	
<style>
.mz_b_menu_xsm_l
	{
		background-color:#dddddd;
		color: #000055;
		font-size:0.8em;
		width:90px;
		height:25px;
			
	}	
.mz_srch_btn
	{
		background-color:#f9c338;
		color: #000055;
		font-size:0.8em;
		width:150;
		height:25px;
		border-radius:5px;
			
	}		
</style>

<script language="javascript">
function mz_keyword_search()
{
	if (document.kw_search_form.kw_search.value="")
	{
		alert("No keyword specified.  Please enter a keyword.");
	}
	else
	{
		document.kw_search_form.submit();
	}
}	
	
</script>

	<!--body style="background-color: rgb(233, 251, 255);"-->
<body>

<?php


$title_string = "Australian Open Source Directory";
include "./inc/mz_header.php";

$h = new mz_header;

$h->h_logo = "t";
$h->h_return="f";
$h->h_home="f";
$h->h_username="Unknown Guest";
$h->h_title = "<div style=\"font-size:1.3em;color:#79A0F5;background:#ffffff;padding:8px;border-radius:15px 15px;border:2px solid;\">$title_string</div>";
$h->h_date_time = "t";
$h->h_display();

print <<< endprint


<span style="font-weight:bold;">Keyword search</span>
<br>
<form name="kw_search_form" action="mz_keyword_search.php" method="post" enctype="application/x-www-form-urlencoded">
Enter keyword to search for: <INPUT type="text" name="x_keyword" size="50" maxlength="50" id="x_kw1">
<input type="button" <INPUT class="mz_srch_btn" type="button" name="kw_search" value="Search" onclick="javascript:mz_keyword_search()">
</form>
<hr>		
endprint



?>

</htm>

