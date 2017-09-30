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
.mz_srch_btn
	{
		background-color:#f9c338;
		color: #000055;
		font-size:1em;
		width:150;
		height:30px;
		border-radius:5px;
			
	}	
.srch_1
{
		background-color:#fefefe;
		color: #000055;
		font-size:0.8em;
		margin-left:20px;
		margin-right:20px;
		padding:20px;
		line-height:1.8;
		border-radius:12px;
}	
.disclaimer
{
	background-color:#fefefe;
		color: #000055;
		font-size:0.8em;
		margin-left:20px;
		margin-right:20px;
		padding:20px;
		line-height:1.5;
		border-radius:12px;
}	
</style>

<script language="javascript">
function mz_prod_search()
{

	location.href="./mz_dir_search_1.php";
	
}	
function mz_keyword_search()
{

	location.href="./mz_dir_search_2.php";
	
}	
function mz_category_search()
{

	location.href="./mz_dir_search_3.php";
	
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

<div class="srch_1">

<input type="button" class="mz_srch_btn" name="search-btn1" value="Product Search" onclick="javascript:mz_prod_search()">
<br>If you know exactly what software product or service you are looking for, use Product Search. It is faster.
<hr>
<input type="button" class="mz_srch_btn" name="search-btn2" value="Keyword Search" onclick="javascript:mz_keyword_search()">
<br>If Product Search does not give satisfactory result or you do not know exactly what product you are looking for, use Keyword Search. It will search more thoroughly and can be slower.<hr>
<input type="button" class="mz_srch_btn" name="search-btn3" value="Category Search" onclick="javascript:mz_category_search()">
<br>If you want to search for provider servicing a particular business area or industry, use Category Search.
<hr>
</div>
<p>
<div class="disclaimer">
<span style="font-weight:bold;">Disclaimer</span><br><br>
OSIA maintains the Australian Open Source Directory as a service to business, organisations and individuals looking for IT business with expertise in and offering products and services using open source software.  The information available using the search function about the IT business is provided by the business themselves.  OSIA does not verify the accuracy and correctness of the information. In using the search facility you agree that OSIA will not be held liable for errors, inaccuracy and incorrect information that may be made available  by the IT business who list their products and services through website.
</div>


<!--span style="font-weight:bold;">Keyword search</span>
<br>
<form name="kw_search_form" action="mz_keyword_search.php" method="post" enctype="application/x-www-form-urlencoded">
Enter keyword to search for: <INPUT type="text" name="x_keyword" size="50" maxlength="50" id="x_kw1">
<input type="button" <INPUT class="mz_b_menu_xsm_l" type="button" name="kw_search" value="Search" onclick="javascript:mz_keyword_search()">
</form-->
		
endprint



?>

</htm>

