<?php

//$w_data = new DOMDocument('1.0','utf-8');

class mz_user
{
	public $mz_userid, $mz_surname, $mz_fname, $mz_oname, $mz_dob, $mz_gender;
	public $mz_add1, $mz_add2, $mz_city, $mz_pcode, $mz_state, $mz_country; 
	public $mz_phone, $mz_phone_mob, $mz_alt_cont, $mz_email, $mz_orgname, $mz_create_date;

	public function mz_user_save(&$mz_db)
	{
			//$w_sql1= "insert into mz_user values('$this->mz_userid', 
		//	'$this->mz_sname', '$this->mz_fname', '$this->mz_oname', '$this->mz_dob','$this->gender',
		//	'$this->add1', '$this-.add2','$this->city','$this->state','$this->country','$this->pcode', 
		//	'this->mz_email','$this->mz_phone','$this->mz_mob','this->mz_alt_cont','1'";
		
		//chekc user existence for Userid
		$w_sql = "select * from mz_user where mz_user_id = '$this->mz_userid' ";
		
		//print $w_sql;
		
		$w_stm = $mz_db->prepare($w_sql);
		$w_stm->execute();
		
		$w_rec  = $w_stm->fetch(PDO::FETCH_ASSOC);
				
		if  (isset($w_rec) && $w_rec > 0)
		{	
			echo "UserID is already being used. Please specify a new one.";
		}
		else
		{

			// we dont actually save gender and dob below
			$w_sql= "insert into mz_user values('$this->mz_userid', 
			'$this->mz_sname', '$this->mz_fname', '$this->mz_oname',
			'$this->mz_add1', '$this->mz_add2','$this->mz_city','$this->mz_state','$this->mz_country','$this->mz_pcode', 
			'$this->mz_email','$this->mz_phone','$this->mz_phone_mob','$this->mz_alt_cont','1')";
	
			$mz_db->exec($w_sql);
		
			echo "New User Record Saved.";
		}	
	
	}
	
	public function mz_user_add()
	{
		$this.mz_user_save($mz_db);
	}
	
	public function mz_get_user($mz_search_key, $x_st, &$mz_db)
	{
			
		
		$w_search_key = strtolower(trim($mz_search_key));
			
//		$w_data = new DOMDocument('1.0', 'utf-8');


		if ($x_st == 'k')
		{
			$w_query_s = "select * from mzuser where 
			(lower(surname) like lower('$w_search_key%')) or 
			(lower(orgname) like lower('$w_search_key%')) order by fname||surname limit 20;";
		}
		elseif ($x_st == 'id')
		{
			$w_query_s = "select * from mzuser where 
			(id = '$w_search_key')";
		}		
		
		$w_stm = $mz_db->prepare($w_query_s);
$w_stm->execute();

$w_rec  = $w_stm->fetch(PDO::FETCH_ASSOC);

$w_rec_no = $w_stm->rowCount();

if ($w_rec_no > 0)
{
		
		$w_stm = $mz_db->prepare($w_query_s);
		$w_stm->execute();
		
		$w_rec  = $w_stm->fetch(PDO::FETCH_ASSOC);
		
		$w_rec_no = $w_stm->rowCount();
			
					
		if  (isset($w_rec) && $w_rec_no == 1)
		{
			
		$w_member_array[] = array("mz_t_rec_no" => 1);
			
		$this->mz_userid = $w_rec["id"];
		$this->mz_surname = $w_rec["surname"];
		$this->mz_fname = $w_rec["fname"];
		$this->mz_oname = $w_rec["oname"];
		$this->mz_add1 = $w_rec["add_1"];
		$this->mz_add2 = $w_rec["add_2"];
		$this->mz_city = $w_rec["city"];
		$this->mz_state = $w_rec["state"];
		$this->mz_pcode = $w_rec["pcode"];
		$this->mz_country = $w_rec["country"];
		$this->mz_phone = $w_rec["phone"];
		$this->mz_mob_phone= $w_rec["mphone"];
		$this->mz_alt_cont = $w_rec["sec_contact"];
		$this->mz_email = $w_rec["email_add"];
		$this->mz_alt_phone = $w_rec["sec_contact_phone"];
		$this->mz_orgname = $w_rec["orgname"];
		$this->mz_status = $w_rec["rec_status"];
		$this->mz_ref = $w_rec["reference"];
		$this->mz_base_dir = $w_rec["base_dir"];
		$this->mz_create_date = $w_rec["rec_create_date"];
		$this->mz_active_date = $w_rec["active_date"];
		$this->mz_category = $w_rec["category"];
		
		
		$w_member_array[] = array(
			"rec_no" => $w_rec_no,
			"id" => $this->mz_userid,
			"surname" => $this->mz_surname,
			"fname" => $this->mz_fname,
			"orgname" => $this->mz_orgname,
			"add1" => $this->mz_add1,
			"add2" => $this->mz_add2,
			"city" => $this->mz_city,
			"state" => $this->mz_state,
			"pcode" => $this->mz_pcode,
			"country" => $this->mz_country,
			"phone" => $this->mz_phone,
			"mphone" => $this->mz_mob_phone,
			"sec_contact" => $this->mz_alt_cont,
			"email_add" => $this->mz_email,
			"sec_contact_phone" => $this->mz_alt_phone,
			"rec_status" => $this->mz_status,
			"reference" => $this->mz_ref,
			"base_dir" => $this->mz_base_dir,
			"rec_create_date" => $this->mz_create_date,
			"rec_active_date" => $this->mz_active_date,
			"category" => $this->mz_category
				);
		
		print json_encode($w_member_array);
		
		$mz_db = null;

	
		}
		elseif  (isset($w_rec) && $w_rec_no > 1)
		{
			//print ("here again".$w_rec_no);
			
			$w_member_array[] = array("mz_t_rec_no" => $w_rec_no);
			
			for ($i=1;$i<=$w_rec_no;$i=$i+1)
			{
				
				$this->mz_userid = $w_rec["id"];
		$this->mz_surname = $w_rec["surname"];
		$this->mz_fname = $w_rec["fname"];
		$this->mz_oname = $w_rec["oname"];
		$this->mz_orgname = $w_rec["orgname"];
		$this->mz_status = $w_rec["rec_status"];
		
		/* $this->mz_add1 = $w_rec["add_1"];
		$this->mz_add2 = $w_rec["add_2"];
		$this->mz_city = $w_rec["city"];
		$this->mz_state = $w_rec["state"];
		$this->mz_pcode = $w_rec["pcode"];
		$this->mz_country = $w_rec["country"];
		$this->mz_phone = $w_rec["phone"];
		$this->mz_mob_phone= $w_rec["mphone"];
		$this->mz_alt_cont = $w_rec["sec_contact"];
		$this->mz_email = $w_rec["email_add"];
		$this->mz_alt_phone = $w_rec["sec_contact_phone"];
		$this->mz_ref = $w_rec["reference"];
		$this->mz_base_dir = $w_rec["base_dir"];
		$this->mz_create_date = $w_rec["rec_create_date"]; */
				
			$w_member = array(
			"rec_no" => $i,
			"id" => $this->mz_userid,
			"surname" => $this->mz_surname,
			"fname" => $this->mz_fname,
			"orgname" => $this->mz_orgname,
			"rec_status" => $this->mz_status,
			);
			
			/*
			"add1" => $this->mz_add1,
			"add2" => $this->mz_add2,
			"city" => $this->mz_city,
			"state" => $this->mz_state,
			"pcode" => $this->mz_pcode,
			"country" => $this->mz_country,
			"phone" => $this->mz_phone,
			"mphone" => $this->mz_mob_phone,
			"sec_contact" => $this->mz_alt_cont,
			"email_add" => $this->mz_email,
			"sec_contact_phone" => $this->mz_alt_phone,
			
			"reference" => $this->mz_ref,
			"base_dir" => $this->mz_base_dir,
			"rec_create_date" => $this->mz_create_date
			); */
							
			//$w_member_array[] = array("mz_rec" => $w_member);
			$w_member_array[] = array($w_member);
			
			$w_rec  = $w_stm->fetch(PDO::FETCH_ASSOC);
			}
			
			//"surname" => $this->mz_surname,
			//"fname" => $this->mz_fname,
			
			print json_encode($w_member_array);
			
			//echo " : ".$w_rec_no." records found matching search criteria.";
		/*
			$mz_user_list_html =<<< endprint
			<b>More that one record found matching Surname search criteria.  Please select User from list below.</b>
		
			<br><div style="margin-left:20px;margin-top:10px;;">
endprint;
			$k = 1;
			//$mz_user_list_html = "";
			do
			{
			
			$w_userid = $w_rec["mz_user_id"];
			$w_line = ucfirst($w_rec["mz_user_fname"])." ".ucfirst($w_rec["mz_user_sname"]);
			$mz_user_list_html .= $k.": <a href=\"javascript:mz_get_user(".$w_userid.",'u')\">".$w_line."</a><br>";
			//$mz_user_list_html .= "number: ".$ku."<br>";
			
			$w_rec = $w_stm->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);
			  $k++;
			//print $mz_user_list_html;
			}while($w_rec); 
			
			 $mz_user_list_html .= "</div>";
				
			*/
		}
		else
		{
			/*		
			$w_el = $w_data->createElement('mz_user');
			$mz_user = $w_data->appendChild($w_el);
		
			$w_el = $w_data->createElement('mz_rec_no');
			$w_userid = $mz_user->appendChild($w_el);
			$ct = $w_data->createTextNode(utf8_encode(0));
			$w_userid->appendChild($ct);
			
			$w_el = $w_data->createElement('mz_userid');
			$w_userid = $mz_user->appendChild($w_el);
			$ct = $w_data->createTextNode(utf8_encode($mz_search_key));
			$w_userid->appendChild($ct);
			
			$w_data->formatOutput = true;
			$x_data = str_replace("\n","",$w_data->saveXML());
			*
			*/
		}	
		
		//echo $x_data;
	}
		
	}
	
	
public function mz_get_user_report($mz_query, $mz_report_title, &$mz_db)
{
			
	$w_query_s = $mz_query;
				
	$w_stm = $mz_db->prepare($w_query_s);
	
	$w_stm->execute();

	$w_rec  = $w_stm->fetch(PDO::FETCH_ASSOC);

	$w_rec_no = $w_stm->rowCount();
	
	if ($w_rec_no > 0)
	{
		
		$w_stm = $mz_db->prepare($w_query_s);
		$w_stm->execute();
		
		$w_rec  = $w_stm->fetch(PDO::FETCH_ASSOC);
		
		$w_rec_no = $w_stm->rowCount();
			
					
		if  (isset($w_rec) && $w_rec_no == 0)
		{
			
		$w_member_array[] = array("mz_report_title" => $mz_report_title,
									"mz_t_rec_no" => 1);			
		$this->mz_userid = $w_rec["id"];
		$this->mz_surname = $w_rec["surname"];
		$this->mz_fname = $w_rec["fname"];
		$this->mz_oname = $w_rec["oname"];
		$this->mz_add1 = $w_rec["add_1"];
		$this->mz_add2 = $w_rec["add_2"];
		$this->mz_city = $w_rec["city"];
		$this->mz_state = $w_rec["state"];
		$this->mz_pcode = $w_rec["pcode"];
		$this->mz_country = $w_rec["country"];
		$this->mz_phone = $w_rec["phone"];
		$this->mz_mob_phone= $w_rec["mphone"];
		$this->mz_alt_cont = $w_rec["sec_contact"];
		$this->mz_email = $w_rec["email_add"];
		$this->mz_alt_phone = $w_rec["sec_contact_phone"];
		$this->mz_orgname = $w_rec["orgname"];
		$this->mz_status = $w_rec["rec_status"];
		$this->mz_ref = $w_rec["reference"];
		$this->mz_base_dir = $w_rec["base_dir"];
		$this->mz_create_date = $w_rec["rec_create_date"];
		$this->mz_active_date = $w_rec["active_date"];
		$this->mz_category = $w_rec["category"];
		
		
		$w_member_array[] = array(
			"rec_no" => $w_rec_no,
			"id" => $this->mz_userid,
			"surname" => $this->mz_surname,
			"fname" => $this->mz_fname,
			"orgname" => $this->mz_orgname,
			"add1" => $this->mz_add1,
			"add2" => $this->mz_add2,
			"city" => $this->mz_city,
			"state" => $this->mz_state,
			"pcode" => $this->mz_pcode,
			"country" => $this->mz_country,
			"phone" => $this->mz_phone,
			"mphone" => $this->mz_mob_phone,
			"sec_contact" => $this->mz_alt_cont,
			"email_add" => $this->mz_email,
			"sec_contact_phone" => $this->mz_alt_phone,
			"rec_status" => $this->mz_status,
			"reference" => $this->mz_ref,
			"base_dir" => $this->mz_base_dir,
			"rec_create_date" => $this->mz_create_date,
			"rec_active_date" => $this->mz_active_date,
			"category" => $this->mz_category
				);
		
		print json_encode($w_member_array);
		
		$mz_db = null;

	
		}
		elseif  (isset($w_rec) && $w_rec_no > 0)
		{
			//print ("here again".$w_rec_no);
			
			$w_member_array[] = array("mz_report_title" => $mz_report_title, 			"mz_t_rec_no" => $w_rec_no);
			
			for ($i=1;$i<=$w_rec_no;$i=$i+1)
			{
				
				$this->mz_userid = $w_rec["id"];
		$this->mz_surname = $w_rec["surname"];
		$this->mz_fname = $w_rec["fname"];
		$this->mz_oname = $w_rec["oname"];
		$this->mz_orgname = $w_rec["orgname"];
		$this->mz_status = $w_rec["rec_status"];
		
		/* $this->mz_add1 = $w_rec["add_1"];
		$this->mz_add2 = $w_rec["add_2"];
		$this->mz_city = $w_rec["city"];
		$this->mz_state = $w_rec["state"];
		$this->mz_pcode = $w_rec["pcode"];
		$this->mz_country = $w_rec["country"];
		$this->mz_phone = $w_rec["phone"];
		$this->mz_mob_phone= $w_rec["mphone"];
		$this->mz_alt_cont = $w_rec["sec_contact"];
		$this->mz_email = $w_rec["email_add"];
		$this->mz_alt_phone = $w_rec["sec_contact_phone"];
		$this->mz_ref = $w_rec["reference"];
		$this->mz_base_dir = $w_rec["base_dir"];
		$this->mz_create_date = $w_rec["rec_create_date"]; */
				
		$w_member = array(
			"rec_no" => $i,
			"id" => $this->mz_userid,
			"surname" => $this->mz_surname,
			"fname" => $this->mz_fname,
			"orgname" => $this->mz_orgname,
			"rec_status" => $this->mz_status,
			);
			
			/*
			"add1" => $this->mz_add1,
			"add2" => $this->mz_add2,
			"city" => $this->mz_city,
			"state" => $this->mz_state,
			"pcode" => $this->mz_pcode,
			"country" => $this->mz_country,
			"phone" => $this->mz_phone,
			"mphone" => $this->mz_mob_phone,
			"sec_contact" => $this->mz_alt_cont,
			"email_add" => $this->mz_email,
			"sec_contact_phone" => $this->mz_alt_phone,
			
			"reference" => $this->mz_ref,
			"base_dir" => $this->mz_base_dir,
			"rec_create_date" => $this->mz_create_date
			); */
							
			//$w_member_array[] = array("mz_rec" => $w_member);
			$w_member_array[] = array($w_member);
			
			$w_rec  = $w_stm->fetch(PDO::FETCH_ASSOC);
			}
			
			//"surname" => $this->mz_surname,
			//"fname" => $this->mz_fname,
			
			print json_encode($w_member_array);
			
			$mz_db = null;
		}
		else
		{
		
		}	
	
	}
		
}
	
	
	public function mz_user_show()
	{
		print <<< endprint
		
		<script language="javascript">
		
		document.form1.value.x_sname = "$this->mz_sname";
		document.form1.value.x_fname = "$this->mz_fname";
		document.form1.value.x_oname = "$this->mz_oname";
		dcoument.form1.value.x_emai_add = "this->mz_email;
		
		</script>
endprint;

	}
	
	public function m_do_wkspace_03()
	{
		
	}
	
	public function mz_user_modify()
	{
	}
	
	public function mz_user_list()
	{
	}
	public function mz_user_del()
	{
	}
	
	public function mz_user_passwd()
	{
	}
	
}	
	
?>	
