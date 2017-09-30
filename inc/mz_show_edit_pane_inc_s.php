<?php

print <<< endprint

<script>

function mz_save_record_s(f_userid)
{

	w_url = "./inc/mz_save_edit_s.php";
	
	var params= "x_orgname="+document.form_edit_s.x_orgname.value;
	params=params+"&x_user_id="+ f_userid;
	params=params+"&x_fname="+document.form_edit_s.x_fname.value;
	params=params+"&x_surname="+document.form_edit_s.x_surname.value;
	params=params+"&x_email_add="+document.form_edit_s.x_email_add.value;
	params=params+"&x_create_date="+document.form_edit_s.x_create_date.value;
	params=params+"&x_phone="+document.form_edit_s.x_phone.value;
	params=params+"&x_mphone="+document.form_edit_s.x_mphone.value;
	params=params+"&x_addr_1="+document.form_edit_s.x_addr_1.value;
	params=params+"&x_addr_2="+document.form_edit_s.x_addr_2.value;
	params=params+"&x_suburb="+document.form_edit_s.x_suburb.value;
	params=params+"&x_pcode="+document.form_edit_s.x_pcode.value;
	params=params+"&x_country="+document.form_edit_s.x_country.value;
	params=params+"&x_state="+document.form_edit_s.x_state.value;
	params=params+"&x_second_name="+document.form_edit_s.x_second_name.value;
	params=params+"&x_second_phone="+document.form_edit_s.x_second_phone.value;
	params=params+"&x_passwd_1="+document.form_edit_s.x_passwd_1.value;
	params=params+"&x_status="+document.form_edit_s.x_status.value;
	//params=params+"&x_cat="+document.form_edit_s.x_cat.value;
	//params=params+"&x_rec_no="+document.form_edit_s.x_rec_no.value;
	
	
	mz_data.open("POST", w_url, true);
	mz_data.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	mz_data.setRequestHeader("Content-length", params.length);
	mz_data.setRequestHeader("Connection", "close");
	
	//location.href = w_url;
	
	mz_data.onreadystatechange = mz_save_edit_response;
	mz_data.send(params); 
}

function mz_save_edit_response()
{
	if (mz_data.readyState == 4)
	{
		if (mz_data.status == 200)
		{
			alert(mz_data.responseText);
		}	
	}	
	else 
	{
	//alert("Error!! ");
	}
	
}

</script>


<style>
.mz_b_menu_sm_l
	{
		background-color:#dddddd;
		color: #000055;
		font-size:0.9em;
		width:150px;
		height:30px;
			
	}	
</style>

		
<div id="mz_list" 
style="margin-left:10px;position:inherit;top:-20px;left:10%;height:80%;width:35%;
z-index:100;border:solid;border-width:1px;padding-left:10px;padding-right:10px;padding-top:10px;
background-color:#fafafa;opacity:0.97;visibility:hidden;">
<div style="margin-left:10px;">
<div style="text-align:right;position:relative;top:-10px;right:-10px;">
<input type="button" style="height:24px; width:24px;background-color:#ffffff;font-size:12px;text-align:center; solid;font-weight:bold;color:#880000;" name="Cancel" value="X" onclick="close_mzlist()">
</div>

</div>

</div>	

<div id="wait_d" style="position:inherit;top:5%;left:50%;z-index:20;visibility:hidden;">
		<img id="wait_anim"src="./mz_img/wait_animation.gif" width="30px" alt="Wait ...loading" align="bottom">
</div>

<div style="position:relative;top:-10px;z-index:inherit;">

<!--form name="form_key">
<table width="98%" align="center" bgcolor="#D7E3F4" cellpadding="3" style="font-size: 12px;margin-top:-1em;">

<tr>
  	<td width=15%>
		Find Member with name:
  	</td>
  	<td width:50%>
		<INPUT type="text" name="x_find" size="25" maxlength="25">
		<INPUT class="mz_b_menu_sm_l" type="button" value="Find Member" name="find_member" 
		onclick=mz_show_anim();document.form_edit.reset();mz_get_user(document.form_key.x_find.value,"k")>
		
 	</td>
  	<!--td>Status:<INPUT type="text" name="x_status" size="20" maxlength="20" disabled style="background:#d4d4d4;fontSize:1.2em;"></td-->
  	</tr>
</table>
</form-->

</div>

<FORM name="form_edit_s" action="inc/mz_save_edit_s.php" method="post" enctype="application/x-www-form-urlencoded">
	$w_ref_tag
    <table width="98%" align="center" bgcolor="#D7E3F4" cellpadding="3" style="font-size: 12px;margin-top:-1em;">
   <tbody>
	<tr>
	<TD colspan=4>
		<div style="background-color: #2E2ECA;  color : #ffffff; font-size : 12px; padding:2px; text-align:center;">Edit Record: Please edit information below then [save] or select [delete] to delete the  record.</div>
	<hr>
	</TD>
	</tr>
  	
  	<tr>
      <td  valign="top" width="15%">Organisation name:</td>
		<td valign="top" width="30%"><INPUT type="text" name="x_orgname" size="40" maxlength="40">
		<br><span style="font-size:10px; color:#880000">If you are registering as an individual please leave this field blank.</span>
		</td>
		<!--td valign="top">
		Member Category: <span style="padding-left:30px;">
		</td>
		<td valign="top">
		<INPUT type="text" name="x_category" size="3" maxlength="3">
		</td-->
    </tr>
    <tr>
      <td>First name:</td>
      <td><INPUT type="text" name="x_fname" size="25" maxlength="25"></td>
		<td >Surname:</td>
		
		<td><INPUT type="text" name="x_surname" size="25" maxlength="25"></td>
		<!--td>
		<input type="text" name="x_dob_d" size="3"maxlength="2">/
		<input type="text" name="x_dob_m" size="3"maxlength="2">/
		<input type="text" name="x_dob_y" size="5"maxlength="4">
		<input type="hidden" name="x_dob">
		
		<span style="border:solid;border-width:1px; padding-top:5px;padding-left:5px;padding-right;5px;padding-bottom:5px;">
		F:<input type="radio" name="gender" value="f" style="position:relative;top:+2px;">
		| M:<input type="radio" name="gender" value="m" style=position:relative;top:+2px;">
		</span>
		</td-->
    </tr>
	<tr>
    <td>Email address:</td>
		<td><INPUT type="text" name="x_email_add" size="30" maxlength="60" onchange=set_login_name()>
		<br><span style="font-size:10px; color:#880000">Please ensure that the email address is valid.</span></td>
	</tr>
	<tr>	
		<td>
		Member since: <span style="padding-left:30px;">
		</td>
		<td>
		<INPUT type="text" name="x_create_date" size="15" maxlength="15" disabled> (yyyy-mm-dd)</span>
		</td>
		<!--td>
		Member active since:
		</td>
		<td valign="top">
		<INPUT type="text" name="x_active_date" size="15" maxlength="15"> (yyyy-mm-dd)
		</td-->
	</tr>
    <tr><td>Phone number:</td>
      <td valign="top"><INPUT type="text" name="x_phone" size="15" maxlength="15">
		</td>
	  <td>Mobile phone number:</td>
      <td valign="top"><INPUT type="text" name="x_mphone" size="15" maxlength="15">
		</td>
    </tr>
	
		<tr>
		<TD width=15%>
		Address line 1:
		</TD>
		<TD width=* colspan=3>
		<INPUT type="text" name="x_addr_1" size="30" maxlength="30"> (Building, House, Flat or Unit num / Block num and Street name if applicable)
		</TD>
		</tr>
		<tr></tr>
		<TD width=15%>
		Address line 2:
		</TD>
		<TD width=25%>
		<INPUT type="text" name="x_addr_2" size="30" maxlength="30">
		</TD>
		<td>City</td>
		<td><INPUT type="text" name="x_suburb" size="30" maxlength="30"></td>
		</TR>
		<tr>
		<TD width=15%>
		Postcode:
		</TD>
		<TD width=35%>
		<INPUT type="text" name="x_pcode" size="10" maxlength="10">
		</TD>
		<TD width=15%>
		State/Province:
		</TD>
		<TD width=35%>
		<INPUT type="text" name="x_state" size="30" maxlength="30">
		</TD>
		</TR>
		<tr>
		<TD width=15%>
		Country:
		</TD>
		<TD width=35%>
		<INPUT type="text" name="x_country" size="20" maxlength="20">
		</TD>
		<TD width=15%>
		Member Status:
		</TD>
		<TD width=35%>
		<INPUT type="text" name="x_status" size="20" maxlength="20" disabled style="background:#d4d4d4;font-size:1.2em;fontWeight:bold;">
		</TD>
		</TR>
		<tr>
	<td width=15%>Alternative contact name:</td>
	<td width=35%><INPUT type="text" name="x_second_name" size="20" maxlength="20"</td>
	
	
	<td width=15%>Alternative contact phone:</td>
	<td width=35%><INPUT type="text" name="x_second_phone" size="15" maxlength="15"</td>
	</tr>
	
	<td width=15%>Change Password:</td>
	<td width=35%><INPUT type="password" name="x_passwd_1" size="20" maxlength="20"</td>
	
	
	<td width=15%>Confirm Password:</td>
	<td width=35%><INPUT type="password" name="x_passwd_2" size="20" maxlength="20"</td>
	</tr>
	<!--/table-->
	</td>
	</tr>
	
	<tr>
	
	</tr>
	
	<tr>
	<td colspan=4><hr></td>
	</tr>
	<TD colspan=4 align="center">
		<INPUT class="mz_b_menu_sm_l" type="button" value="Save Record" name="Save" onclick="javascript:mz_save_record_s($this->h_userid)">
		&nbsp;&nbsp;&nbsp;
		<!--INPUT class="mz_b_menu_sm_l" type="button" value="Suspend Record" name="suspend" onclick="javascript:mz_change_member_status(2)">	
		&nbsp;&nbsp;&nbsp;
		<INPUT class="mz_b_menu_sm_l" type="button" value="Re-activate Membership" name="reinstate" onclick="javascript:mz_change_member_status(1)">
		&nbsp;&nbsp;&nbsp;
		<INPUT class="mz_b_menu_sm_l" type="button" value="Renew Membership" name="renew" onclick="javascript:mz_renew_member()">
		&nbsp;&nbsp;&nbsp;
		<INPUT class="mz_b_menu_sm_l" type="button" value="Cancel Membership" name="cancel" onclick="javascript:mz_change_member_status(3)">
		&nbsp;&nbsp;&nbsp; >
		<INPUT class="mz_b_menu_sm_l" type="button" value="Delete Record" name="delete_record" onclick="javascript:mz_change_member_status(6)"-->
	</td>
	</tr>
	<tr><TD colspan=4>
		<div style="background-color : #2E2ECA; color : #ffffff; font-size : 10px; padding:2px; text-align:center;"> The information you provide here will never be disclosed to any other individual or organisation, unless required by a court of law. </div>
	</TD></tr>
  </tbody>
</table>
<input type="text" name="x_id" hidden>
</form>

endprint;

?>
