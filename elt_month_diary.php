<?php


require "./inc/elt_calendar.php";


if (isset($_REQUEST["x_month"]))
{
	$w_month = trim(urldecode($_GET["x_month"]));
	$w_year =  trim(urldecode($_GET["x_year"])); //x_year also there!
}


echo ("<div style=\"width:100%; margin-right:50px; margin-top:20px; \">");


cal_month_show($w_month, $w_year, $w_user_id, $elt_db_pdo) ;


echo ("</div>");


?>
