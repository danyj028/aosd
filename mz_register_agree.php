<script language="javascript">
function go_login()
{
	location.href="/mrs/mz_login.php";
}
</script>

<?php
function confirm_email($f_m_name, $f_email_to)
{

$email_txt = <<<endt

To : $f_m_name\n
        
  Thank you for registering with the Australian Open Source Directory, hosted by OSIA.\r\n
  Your profile will be checked before it becomes visible in searches.\r\n
  If you did not register, please go to aosd.osia.com.au and use the contact link to contact OSIA immediately.\r\n
  If you believe that you are entitled to OSIA Member priority listing, please contact OSIA immediately.  \r\n
  Your profile will be upgraded after verification of your status. \r\n
  Please provide us with your feedback on this service so we can make it better.\r\n
  \r\n        
  admin@osia.com.au
  \r\n
  Please also note, this system is currently in early beta status, and available for testing.  While it is useable, some features may change.
  


endt;

//echo $email_txt;

$headers = "From: admin@osia.com.au" . "\r\n" .
    "Reply-To: admin@osia.com.au" ."\r\n" .
    "X-Mailer: PHP/" . phpversion();   

mail($f_email_to, "AOSD Registration confirmation", $email_txt, $headers);

}

require_once "inc/connect_to_db1.php";

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


//check for already existing user !
//echo $w_login_name;
//die();
$w_query = "select id from user_auth where username = '$w_login_name'";

$w_stm = $mz_db->prepare($w_query);
$w_stm->execute();

//$w_db->query($w_query);
$w_rec  = $w_stm->fetch(PDO::FETCH_ASSOC);

$w_rec_no = $w_stm->rowCount();
//if ($w_db->num_rows() >0)

if  (isset($w_rec) && $w_rec_no == 1)
{
	echo $w_login_name." : ";
	echo "<br>The chosen Login name is already being used.  Please choose another one.";
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
	echo $w_email_add." : ";
	echo "<br>The email address is already on record.  Please choose another one.";
}
else
{
	// get new id
	
	
	echo"<br>New Member added.<p>";
///*
	$w_qs = "start transaction";
	$w_q1 = "update mz_data_id set mz_data_int = mz_data_int+1 where mz_id_key = 'u_id' ";
	$w_q2 = "select mz_data_int from mz_data_id where mz_id_key = 'u_id' ";
	$w_qe = "commit";
	
	$w_stm = $mz_db->prepare($w_qs);
	$w_stm->execute();
	$w_stm = $mz_db->prepare($w_q1);
	$w_stm->execute();
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
	
	//echo $w_u_id;
	
	//insert patron record  - record is inserted with rec_status 0 - not active.
	$w_query = "insert into mzuser (id, orgname, surname, fname, add_1, add_2, city, state, country, pcode, email_add, rec_status, phone, mphone, sec_contact, sec_contact_phone, base_dir, reference, member_status) values('$w_u_id','$w_orgname','$w_surname','$w_fname','$w_addr_1','$w_addr_2','$w_suburb','$w_state','$w_country','$w_pcode',
	'$w_email_add','0','$w_phone','$w_mphone','$w_sec_name','$w_sec_phone','mzone','$w_reference',0) ";

//	echo $w_query; //die("here");


	$w_stm = $mz_db->prepare($w_query);
	$w_stm->execute();
		

	//insert user_auth_db record
	//$w_salt = strtoupper(substr($w_login_name, 0,2));
	//$w_cpword = crypt($w_pword, $w_salt);
	$w_cpword = substr(md5($w_login_name.$w_pword),0,20);
	$w_s_username = substr($w_login_name,0,15);  // This is for compatibility with upstream code. It has not use otherwise.

	$w_query="insert into user_auth (id, short_username, username, password, level, auth_string, need_pwd_change, user_db, account_status, last_login) 
	values('$w_u_id','$w_s_username', '$w_login_name', '$w_cpword', '1','','f','mzone','1', current_date)";

	//echo $w_query;
	
	$w_stm = $mz_db->prepare($w_query);
	$w_stm->execute();
	
	//*/

print <<< endprint

	<br>Your record has been saved.  Please go back to the home page, login and create your listing.
	<p>
	There are 3 sections for you to complete.  You must complete your Profile Blurb, or your listing will not show in searches.
	<br>
	The other sections are optional.
	<p>
	A registration confirmation email has been sent to the email address you provided earlier.
	</p>
	
endprint;

confirm_email($w_fname." ".$w_surname, $w_email_add);  //confirmation to applicant
confirm_email($w_fname." ".$w_surname, "admin@osia.com.au");  //confirmation to OSIA admin

}

}	


print <<<  endprint
        
        <br>
        <br>
                
        <INPUT type="button" value="Continue" name="continue" onclick="go_login()">
        
endprint;


?>
