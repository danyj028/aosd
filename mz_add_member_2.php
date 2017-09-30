<?php

require_once "inc/connect_to_db1.php";

//$w_db = new mz_db;

/*$w_ref = "";
if (isset($_REQUEST["x_ref"]))
{
	$w_ref = urldecode(($_REQUEST["x_ref"]));
}*/

$w_orgname = urldecode($_REQUEST["x_orgname"]);
$w_fname = urldecode($_REQUEST["x_fname"]);
$w_surname = urldecode($_REQUEST["x_surname"]);
//$w_oname = urldecode($_REQUEST["x_oname"]);
//$w_dob=urldecode($_REQUEST["x_dob"]);
$w_email_add = urldecode($_REQUEST["x_email_add"]);
$w_phone = urldecode($_REQUEST["x_phone"]);
$w_mphone = urldecode($_REQUEST["x_mphone"]);
$w_addr_1 = urldecode($_REQUEST["x_addr_1"]);
$w_addr_2 = urldecode($_REQUEST["x_addr_2"]);
$w_suburb = urldecode($_REQUEST["x_suburb"]);
$w_pcode = urldecode($_REQUEST["x_pcode"]);
$w_state = urldecode($_REQUEST["x_state"]);
$w_country = urldecode($_REQUEST["x_country"]);
$w_sec_name = urldecode($_REQUEST["x_sec_name"]);
$w_sec_phone = urldecode($_REQUEST["x_sec_phone"]);
$w_login_name = urldecode($_REQUEST["x_login_name"]);
$w_pword = urldecode($_REQUEST["x_pword"]);
$w_find_us = urldecode($_REQUEST["x_find_us"]);
$w_reference = urldecode($_REQUEST["x_reference"]); 


if (trim($w_reference)=="")
{
	$w_reference='_default';
}	

/* $w_re = urldecode($_REQUEST["x_spec_off"]);

$w_re = 0;
if ($w_re == "on")
{
	$w_re = 1;
}
*/


//check for already existing user by email address!
$w_query = "select id from user_auth where username = '$w_login_name'";
$w_stm = $mz_db->prepare($w_query);
$w_stm->execute();

//$w_db->query($w_query);
$w_rec  = $w_stm->fetch(PDO::FETCH_ASSOC);

$w_rec_no = $w_stm->rowCount();
//if ($w_db->num_rows() >0)

if  (isset($w_rec) && $w_rec_no == 1)
{
	
	echo "ERROR: The chosen Login name is already being used.  Please choose another one.";
}
else 
{
	//check email address - cannot be duplicate
$w_query2 = "select id from mzuser where email_add = '$w_email_add'";

$w_stm = $mz_db->prepare($w_query2);
$w_stm->execute();

$w_rec  = $w_stm->fetch(PDO::FETCH_ASSOC);

$w_rec_no = $w_stm->rowCount();

if (isset($w_rec) && $w_rec_no == 1)
{
	echo "The email address is already on record.  Please choose another one.";
}
else
{
	// get new id
	
	
	//echo"<br>New Member";

	$w_qs = "start transaction";
	$w_q1 = "update mz_data_id set mz_data_int = mz_data_int+1 where mz_id_key = 'u_id' ";
	$w_q2 = "select mz_data_int from mz_data_id where mz_id_key = 'u_id' ";
	$w_qe = "commit";
	
	$w_stm = $mz_db->prepare($w_qs);
	$w_stm->execute();
	//$w_stm = $mz_db->prepare($w_q1);
	//$w_stm->execute();
	$w_stm = $mz_db->prepare($w_q2);
	$w_stm->execute();
	$w_rec  = $w_stm->fetch(PDO::FETCH_ASSOC);
	
	$w_stm = $mz_db->prepare($w_qe);
	$w_stm->execute();
	
	/*$w_db->query($w_qs);
	$w_db->query($w_q1);
	 $w_db->query($w_q2);
	//$w_db->query($w_qe);
	*/
	
	//echo($w_rec["mz_data_int"]);
	
	//$mz_db->next_record();
	$w_u_id = $w_rec["mz_data_int"]; 
	
	//$mz_db->query($w_qe);
	
	//insert patron record
	$w_query = "insert into mzuser (id, orgname, surname, fname, add_1, add_2, city, state, country, pcode, email_add, rec_status, phone, mphone, sec_contact, sec_contact_phone, base_dir, reference) values('$w_u_id','$w_orgname','$w_surname','$w_fname','$w_addr_1','$w_addr_2','$w_suburb','$w_state','$w_country','$w_pcode',
	'$w_email_add','1','$w_phone','$w_mphone','$w_sec_name','$w_sec_phone','mzone','$w_reference') ";

	//echo $w_query;


	$w_stm = $mz_db->prepare($w_query);
	$w_stm->execute();
	
	//echo "<br>Record saved<br>";

	//insert user_auth_db record
	$w_login_name = trim(substr($w_login_name,0,20));
	//$w_salt = strtoupper(substr($w_login_name, 0,2));
	//$w_cpword = crypt($w_pword, $w_salt);
	$w_cpword = substr(md5($w_login_name.$w_pword),0,20);

	$w_query="insert into user_auth (id, username_short, username, password, level, auth_string, need_pwd_change, user_db, account_status, last_login) 
	values('$w_u_id','', '$w_login_name', '$w_cpword', '1','','f','mzone','1', current_date)";

	//echo $w_query;
	
	$w_stm = $mz_db->prepare($w_query);
	$w_stm->execute();
	
	echo("New record successfully saved.");

}
}


?>
