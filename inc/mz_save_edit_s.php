<?php

require_once "connect_to_db1.php";

$w_orgname = trim(urldecode($_POST["x_orgname"]));
$w_fname = trim(urldecode($_POST["x_fname"]));
$w_surname = trim(urldecode($_POST["x_surname"]));
$w_email_add = trim(urldecode($_POST["x_email_add"]));
//$w_create_date = trim(urldecode($_POST["x_create_date"]));
$w_phone = trim(urldecode($_POST["x_phone"]));
$w_mphone = trim(urldecode($_POST["x_mphone"]));
$w_addr_1 = trim(urldecode($_POST["x_addr_1"]));
$w_addr_2 = trim(urldecode($_POST["x_addr_2"]));
$w_suburb = trim(urldecode($_POST["x_suburb"]));
$w_pcode = trim(urldecode($_POST["x_pcode"]));
$w_state = trim(urldecode($_POST["x_state"]));
$w_country = trim(urldecode($_POST["x_country"]));
$w_second_name = trim(urldecode($_POST["x_second_name"]));
$w_second_phone = trim(urldecode($_POST["x_second_phone"]));
$w_passwd = trim(urldecode($_POST["x_passwd_1"]));
$w_status = trim(urldecode($_POST["x_status"]));
//$w_cat = trim(urldecode($_POST["x_cat"]));
$w_cat = '1';
$w_user_id = trim(urldecode($_POST["x_user_id"]));

$w_st = 0;
if ($w_status=="ACTIVE")
{
	$w_st = "1";
}
	

//echo "dada";
echo "User_id: ".$w_user_id."  ->";

$w_query = "update mzuser set surname='$w_surname',
			fname='$w_fname',
			add_1='$w_addr_1',
			add_2='$w_addr_2',
			city='$w_suburb',
			state='$w_state',
			pcode='$w_pcode',
			country='$w_country',
			email_add='$w_email_add',
			rec_status='$w_st',
			phone='$w_phone',
			mphone='$w_mphone',
			sec_contact='$w_second_name',
			sec_contact_phone='$w_second_phone',
			orgname='$w_orgname',
			category='$w_cat' where id = '$w_user_id'";
		   
echo $w_query;		   
		   
$w_stm = $mz_db->prepare($w_query);
$w_stm->execute();

//$w_rec  = $w_stm->fetch(PDO::FETCH_ASSOC);

//$w_rec_no = $w_stm->rowCount();

echo "Record Updated";

			
			
			

?>
