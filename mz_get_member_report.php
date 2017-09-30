<?php

include "./inc/mz_user_classes.php";
include "./inc/connect_to_db.php";

$w_report_id = urldecode($_REQUEST["x_report_id"]);
$w_report_title = urldecode($_REQUEST["x_report_title"]);

$w_query_s = "";

switch($w_report_id) {
	
	case 1:
		$w_query_s = "select * from mzuser where rec_status = '1'";
		break;
		
	case 2:
		$w_query_s = "select * from mzuser where rec_status = '5'";
		break;

	case 3:
		$w_query_s = "select * from mzuser where rec_status = '2'";
		break;
		
	case 6:
		$w_query_s = "";
		break;
		
	case 7:
		$w_query_s = "select * from mzuser";
		break;
	
}

$mz_member = new mz_user;

$mz_member->mz_get_user_report($w_query_s, $w_report_title, $mz_db)


?>


