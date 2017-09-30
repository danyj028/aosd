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
.cl_1
	{
		background-color:#fefefe;
		color: #000055;
		font-size:0.8em;
		padding:5px;	
	}	
	
.cl_2
	{
		background-color:#e2edfc;
		color: #0000aa;
		font-size:1em;
		line-height:1.2;
		padding:10px;
		border-radius:5px
		
	}	
	
	.cl_2n
	{
		background-color:#fafafa;
		color: #0000aa;
		font-size:0.8em;
		line-height:1.2;
		padding:10px;
		border-radius:5px;
	}
</style>

<?php

print <<< endprint

<div style="margin-right:20px;margin-left:20px;">

endprint;

$title_string = "Australian Open Source Directory";
include "mz_header.php";

$h = new mz_header;

$h->h_logo = "t";
$h->h_return="f";
$h->h_home="f";
$h->h_username="Unknown Guest";
$h->h_title = "<div style=\"font-size:1.3em;color:#79A0F5;background:#ffffff;padding:8px;border-radius:15px 15px;border:2px solid;\">$title_string</div>";
$h->h_date_time = "t";
$h->h_display();
require_once "connect_to_db1.php";

$w_service_array = array();

//$w_userid = urldecode($_REQUEST["x_userid"]);
$w_scount = urldecode($_REQUEST["x_service_count"]);

/*$w_cb1 = 0;
if (isset($_REQUEST["cb1"]))
{
	$w_cb1 = $_REQUEST["cb1"];
}
$w_cbndx1=$_REQUEST["cbndx1"];

echo $w_cb1, $w_cbndx1, $w_userid, $w_scount."..";
*/

$k=1;
for ($k==1;$k<=$w_scount;$k++)
{
	
	$w_cbxndx="cb".$k;
	$w_cbxndx2="cbndx".$k;
	if (isset($_REQUEST[$w_cbxndx]))
	{
		$w_cbndx = $_REQUEST[$w_cbxndx2];
	
		//echo $w_cbxndx.":".$w_cbndx."<br>";
		$w_service_array[]=$w_cbndx;
	}	
}

$w_ar_count= count($w_service_array);

echo $w_ar_count;

$k2=0;

$w_where_statement = "us.service_id = $w_service_array[0]";

for ($k2=1;$k2<$w_ar_count;$k2++)
{
	$w_where_statement .= " or us.service_id = $w_service_array[$k2]";
}	

//build search query

$w_query = "select u.id, u.orgname, u.surname, u.fname, p.user_tag_line, p.user_url, pc.tag, pc.indx, us.service_id from mz_user_service as us
join mzuser as u on u.id = us.user_id
join mz_user_profile as p on p.user_id = u.id
join mz_prod_category pc on pc.indx=us.service_id where ($w_where_statement) order by random()";

echo $w_query;

$w_stm = $mz_db->prepare($w_query);
$w_stm->execute();

$w_rec  = $w_stm->fetch(PDO::FETCH_ASSOC);

if  (isset($w_rec) && $w_rec > 0)
	{
		$w_rec_no = $w_stm->rowCount();
		
		$k = 1;
		
		for ($k==1;$k<=$w_rec_no;$k++)
		{
			$w_userid = $w_rec["id"];
			$w_tag_line = $w_rec["user_tag_line"];
			$w_org = $w_rec["orgname"];
			$w_surname = $w_rec["surname"];
			$w_fname= $w_rec["fname"];
			$w_url = $w_rec["user_url"];
			
			
			echo $w_userid.": ".$w_tag_line." W: <a href=\"http://".$w_url."\">Go to website</a><br>";
			
			$w_rec  = $w_stm->fetch(PDO::FETCH_ASSOC);
		}
	}
	else
	{
		echo "No record found matching keyword. Please try a different search.";
	}	
				
		

?>
