<?php

require_once "connect_to_db1.php";

//$w_user_id = $_SESSION['ELTuserid'];
$w_user_id = 29;

$w_db = new elt_db;

$w_month = trim(urldecode($_REQUEST["x_month"]));
$w_year = trim(urldecode($_REQUEST["x_year"]));

$w_query="select * from elt_diary_entry where
		 (extract(month from elt_d_date)=$w_month) and
		 (extract(year from elt_d_date) = $w_year) and
		  (elt_d_user_id = '$w_user_id') ";

$w_db->query($w_query);

$w_data = new DOMDocument('1.0');

$w_de_sr =  $w_data->appendChild($w_data->createElement('server_response'));

$w_nr = $w_de_sr->appendChild($w_data->createElement('num_rows'));
$w_nr->appendChild($w_data->createTextNode(utf8_encode($w_db->num_rows())));

while ($w_db->next_record())
{
	
	$w_de = $w_de_sr->appendChild($w_data->createElement('diary_entry'));

	$w_de_uid = $w_de->appendChild($w_data->createElement('user_id'));
	$w_de_uid->appendChild($w_data->createTextNode(utf8_encode($w_db->f("elt_d_user_id"))));
	
	$w_date = $w_de->appendChild($w_data->createElement('date'));
	$w_date->appendChild($w_data->createTextNode(utf8_encode($w_db->f("elt_d_date"))));

	$w_time_start = $w_de->appendChild($w_data->createElement('time_start'));
	$w_time_start->appendChild($w_data->createTextNode(utf8_encode($w_db->f("elt_d_time_start"))));

	$w_time_stop = $w_de->appendChild($w_data->createElement('time_stop'));
	$w_time_stop->appendChild($w_data->createTextNode(utf8_encode($w_db->f("elt_d_time_stop"))));

	$w_wk_id = $w_de->appendChild($w_data->createElement('workout_id'));
	$w_wk_id->appendChild($w_data->createTextNode(utf8_encode($w_db->f("elt_d_wk_id"))));

	$w_fl = $w_de->appendChild($w_data->createElement('fitness_level'));
	$w_fl->appendChild($w_data->createTextNode(utf8_encode($w_db->f("elt_d_fl"))));

	$w_injury = $w_de->appendChild($w_data->createElement('injury'));
	$w_injury->appendChild($w_data->createTextNode(utf8_encode($w_db->f("elt_d_injury"))));

	$w_comment = $w_de->appendChild($w_data->createElement('s_comment'));
	$w_comment->appendChild($w_data->createTextNode(utf8_encode($w_db->f("elt_s_comment"))));

	$w_c_comment = $w_de->appendChild($w_data->createElement('c_comment'));
	$w_c_comment->appendChild($w_data->createTextNode(utf8_encode($w_db->f("elt_c_comment"))));

	$w_aim = $w_de->appendChild($w_data->createElement('aim'));
	$w_aim->appendChild($w_data->createTextNode(utf8_encode($w_db->f("elt_aim"))));
}

$w_data->formatOutput = true;
$w_de = str_replace("\n","",$w_data->saveXML());
echo($w_de);




/*
$w1 = $w_db->f("elt_d_user_id");
$w2 = $w_db->f("elt_d_date");
$w3 = $w_db->f("elt_d_time_start");
$w4 = $w_db->f("elt_d_time_stop");

print <<< endxml
<diary_entry><uid>$w1</uid><date>$w2</date><time_start>$w3</time_start><time_stop>$w4</time_stop></diary_entry>
endxml;
}

*/


?>
