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
		<link rel="stylesheet" href="../elt_css/elt_01.css" type="text/css">
	</head>

<?php

include "connect_to_db.php"; //connect to mrsdb

$title_string = "Australian Open Source Directory";
include "./mz_header.php";

$h = new mz_header;

$h->h_logo = "t";
$h->h_return="f";
$h->h_home="f";
$h->h_username="Unknown Guest";
$h->h_title = "<div style=\"font-size:1.3em;color:#79A0F5;background:#ffffff;padding:8px;border-radius:15px 15px;border:2px solid;\">$title_string</div>";
$h->h_date_time = "t";
$h->h_display();

$w_keyword = urldecode($_REQUEST["x_keyword"]);


//build query on product term

//build query on text search

$w_query = "select u.id, u.fname, u.surname, u.orgname, p.user_tag_line, p.user_url from mz_user_profile p
	join mzuser u on u.id = p.user_id
	where (profile_vector@@to_tsquery('$w_keyword')) order by user_id";
	
	//echo $w_query;die();
	
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


</html>
