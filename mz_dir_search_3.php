<html>
	<head>
		<title>AOSD Category Search</title>
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
function mz_cat_search()
{
	
	document.cat_search_form.submit();

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

<input type="button" <INPUT class="mz_srch_btn" type="button" name="cat_search" value="Search" onclick="javascript:mz_cat_search()">
<span style="font-size:0.8em";>Select categories to search for below.</span>
<div name="cat_search" id="cat_search" style="position:relative;top:+15px;">
<!--form name="cat_search_form" action="mz_prod_cat_search.php" method="post" enctype="application/x-www-form-urlencoded"-->
endprint;

include("inc/mz_prod_cat_search_pane_inc.php");

print <<< endprint
</div>
</form>
	
endprint



?>

</html>

