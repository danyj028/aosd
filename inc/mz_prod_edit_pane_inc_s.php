<?php

function get_user_service_2($f_userid, &$f_user_service_array, &$f_mz_db)
{
	$f_sql = "select * from mz_user_service_2 as m2
		join mz_service_key as sk on m2.service_key_id = sk.service_id
		where m2.user_id =  '$f_userid'";

	$w_stm = $f_mz_db->prepare($f_sql);
	$w_stm->execute();
		
		$w_rec  = $w_stm->fetch(PDO::FETCH_ASSOC);
				
		if  (isset($w_rec) && $w_rec > 0)
		{
			$w_rec_no = $w_stm->rowCount();
			
			$k = 0;
			for ($k==0;$k<$w_rec_no;$k=$k+1)
			{
				$f_user_service_array[$k] = $w_rec["service_title"];
				//$f_user_service_array[$k][1] = $w_rec["tag"];
				$w_rec  = $w_stm->fetch(PDO::FETCH_ASSOC);
			}
			
		}	
}

function get_user_service_area($f_userid, &$f_user_service_area_array, &$f_mz_db)
{
	$f_sql = "select * from mz_user_service_area as ma
	join mz_config_data as mk on ma.service_area_id = mk.config_id
	where ma.user_id =  '$f_userid' and mk.config_name='service_area_id'";

	$w_stm = $f_mz_db->prepare($f_sql);
	$w_stm->execute();
		
		$w_rec  = $w_stm->fetch(PDO::FETCH_ASSOC);
				
		if  (isset($w_rec) && $w_rec > 0)
		{
			$w_rec_no = $w_stm->rowCount();
			
			$k = 0;
			for ($k==0;$k<$w_rec_no;$k=$k+1)
			{
				$f_user_service_area_array[$k] = $w_rec["config_value"];
				//$f_user_service_array[$k][1] = $w_rec["tag"];
				$w_rec  = $w_stm->fetch(PDO::FETCH_ASSOC);
			}
			
		}	
}

/////////////////////

include "connect_to_db.php";
$w_user_service_array_2=[];
$w_user_service_area_array=[];

get_user_service_area($this->h_userid, $w_user_service_area_array, $mz_db);
get_user_service_2($this->h_userid, $w_user_service_array_2, $mz_db);

$w_member_name = "";
print <<< endprint

<script>
function mz_prod_save_record()
{
	/* alert("prod_save"); */
	document.form_p_key_edit.submit();
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


</div>

<FORM name="form_p_key_edit" action="inc/mz_prod_edit_save.php" method="post" enctype="application/x-www-form-urlencoded">
	<input type="hidden" name="x_userid" value="$this->h_userid">
    <table width="98%" align="center" bgcolor="#D7E3F4" cellpadding="3" style="font-size: 12px;margin-top:-1em;">
   <tbody>
	<tr>
	<TD colspan=2>
		<div style="background-color: #7D2308;  color : #ffffff; font-size : 12px; padding:2px; text-align:center;">Edit Products and Services: Please edit information below then [save] or select [delete] to delete the  record.</div>
	<hr>
	</TD>
	</tr>
  	<tr>
      <td>Member: <span style="font-weight:bold;font-size:1.5em;">$w_member_name</span>
      </td>
      <!--td>Website URL: <INPUT type="text" name="x_web_url" size="30" maxlength="60"</td-->
    </tr>
  	
    <tr>
      <td>Service Area:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		ACT:<INPUT type="checkbox" name="ab1" id="ab1">&nbsp;&nbsp;&nbsp;
		NSW:<INPUT type="checkbox" name="ab2" id="ab2">&nbsp;&nbsp;&nbsp;
		NT:<INPUT type="checkbox" name="ab3" id="ab3">&nbsp;&nbsp;&nbsp;
		SA:<INPUT type="checkbox" name="ab4" id="ab4">&nbsp;&nbsp;&nbsp;
		TAS:<INPUT type="checkbox" name="ab5" id="ab5">&nbsp;&nbsp;&nbsp;
		VIC:<INPUT type="checkbox" name="ab6" id="ab6">&nbsp;&nbsp;&nbsp;
		WA:<INPUT type="checkbox" name="ab7" id="ab7">&nbsp;&nbsp;&nbsp;
		AOT:<INPUT type="checkbox" name="ab8" id="ab8">&nbsp;&nbsp;&nbsp;
		Australia:<INPUT type="checkbox" name="ab9" id="ab9">&nbsp;&nbsp;&nbsp;
		NZ:<INPUT type="checkbox" name="ab10" id="ab10">&nbsp;&nbsp;&nbsp;
		ALL:<INPUT type="checkbox" name="ab11" id="ab11">
      </td>
    </tr>
    <tr>
    <td colspan=2>Enter product and service <span style="font-weight:bold">keyword</span> below, 1 item for each entry field.  To delete an item, select tickbox next to item, then click [Delete Selection] below
    <br>
    <hr>
    </td>
    </tr>
	<tr>
		<td colspan=2>
		<table align=center width=90%>
		<tr>
			<td align=center> 1.<INPUT type="text" name="p1" size="30" maxlength="60" id="p1">
			<!--INPUT type="checkbox" name="d1"></td-->
			<td align=center> 2.<INPUT type="text" name="p2" size="30" maxlength="60" id="p2">
			<!--INPUT type="checkbox" name="d2"></td-->		
		</tr>
		<tr>  
			<td align=center> 3.<INPUT type="text" name="p3" size="30" maxlength="60" id="p3">
			<!--INPUT type="checkbox" name="d3"></td-->
			<td align=center> 4.<INPUT type="text" name="p4" size="30" maxlength="60" id="p4">
			<!--INPUT type="checkbox" name="d4"></td-->			
		</tr>
		<tr>  
			<td align=center> 5.<INPUT type="text" name="p5" size="30" maxlength="60" id="p5">
			<!--INPUT type="checkbox" name="d5"></td-->
			<td align=center> 6.<INPUT type="text" name="p6" size="30" maxlength="60" id="p6">
			<!--INPUT type="checkbox" name="d6"></td-->
		</tr>
		<tr>  
			<td align=center> 7.<INPUT type="text" name="p7" size="30" maxlength="60" id="p7">
			<!--INPUT type="checkbox" name="d7"></td-->
			<td align=center> 8.<INPUT type="text" name="p8" size="30" maxlength="60" id="p8">
			<!--INPUT type="checkbox" name="d8"></td-->
		</tr>
		<tr>  
			<td align=center> 9.<INPUT type="text" name="p9" size="30" maxlength="60" id="p9">
			<!--INPUT type="checkbox" name="d9"></td-->
			<td align=center>10.<INPUT type="text" name="p10" size="30" maxlength="60" id="p10">
			<!--INPUT type="checkbox" name="d10"></td-->
		</tr>
		<tr>  
			<td align=center>11.<INPUT type="text" name="p11" size="30" maxlength="60" id="p11">
			<!--INPUT type="checkbox" name="d11"></td-->
			<td align=center>12.<INPUT type="text" name="p12" size="30" maxlength="60" id="p12">
			<!--INPUT type="checkbox" name="d12"></td-->
		</tr>
		<tr>  
			<td align=center>13.<INPUT type="text" name="p13" size="30" maxlength="60" id="p13">
			<!--INPUT type="checkbox" name="d13"></td-->
			<td align=center>14.<INPUT type="text" name="p14" size="30" maxlength="60" id="p14">
			<!--INPUT type="checkbox" name="d14"></td-->
		</tr>
		<tr>  
			<td align=center>15.<INPUT type="text" name="p15" size="30" maxlength="60" id="p15">
			<!--INPUT type="checkbox" name="d15"></td-->
			<td align=center>16.<INPUT type="text" name="p16" size="30" maxlength="60" id="p16">
			<!--INPUT type="checkbox" name="d16"></td-->
		</tr>
		<tr>  
			<td align=center>17.<INPUT type="text" name="p17" size="30" maxlength="60" id="p17">
			<!--INPUT type="checkbox" name="d17"></td-->
			<td align=center>18.<INPUT type="text" name="p18" size="30" maxlength="60" id="p18">
			<!--INPUT type="checkbox" name="d18"></td-->
		</tr>
		<tr>  
			<td align=center>19.<INPUT type="text" name="p19" size="30" maxlength="60" id="p19">
			<!--INPUT type="checkbox" name="d19"></td-->
			<td align=center>20.<INPUT type="text" name="p20" size="30" maxlength="60" id="p20">
			<!--INPUT type="checkbox" name="d20"></td-->
		</tr>
	</td>
	
	</table>
	</td>
	</tr>
	
	<tr>
	
	</tr>
	
	<tr>
	<td colspan=4><hr></td>
	</tr>
	<TD colspan=4 align="center">
		<INPUT class="mz_b_menu_sm_l" type="button" value="Save Changes" name="Save" onclick="javascript:mz_prod_save_record()">
		&nbsp;&nbsp;&nbsp;
		<!--INPUT class="mz_b_menu_sm_l" type="button" value="Delete Selection" name="delete" onclick="javascript:mz_change_member_status(2)">	
		&nbsp;&nbsp;&nbsp;
		<!INPUT class="mz_b_menu_sm_l" type="button" value="Re-activate Membership" name="reinstate" onclick="javascript:mz_change_member_status(1)">
		&nbsp;&nbsp;&nbsp;
		<INPUT class="mz_b_menu_sm_l" type="button" value="Renew Membership" name="renew" onclick="javascript:mz_renew_member()">
		&nbsp;&nbsp;&nbsp; -->
		<INPUT class="mz_b_menu_sm_l" type="button" value="Cancel Changes" name="cancel" onclick="javascript:mz_change_member_status(3)">
	</td>
	</tr>
	<tr><TD colspan=4>
		<div style="background-color : #7D2308; color : #ffffff; font-size : 10px; padding:2px; text-align:center;">&nbsp</div>
	</TD></tr>
  </tbody>
</table>
<input type="text" name="x_id" hidden>
</form>
<span style="font-size:8px;">(AOT: Australian Overseas Territories)</span>


<script>
endprint;

$w_a_array_l = sizeof($w_user_service_area_array);

$k=0;
for ($k==0;$k<$w_a_array_l;$k++)
{
	$k1=$k+1;
	
	//echo "dadadada".$w_user_service_area_array[$k];
	
	switch ($w_user_service_area_array[$k]) {
		case "ACT":
			echo ("document.getElementById(\"ab1\").checked = true;");
			break;
		case "NSW":
			echo ("document.getElementById(\"ab2\").checked = true;");
			break;
		case "NT":
			echo ("document.getElementById(\"ab3\").checked = true;");
			break;
		case "SA":
			echo ("document.getElementById(\"ab4\").checked = true;");
			break;
		case "TAS":
			echo ("document.getElementById(\"ab5\").checked = true;");
			break;
		case "VIC":
			echo ("document.getElementById(\"ab6\").checked = true;");
			break;
		case "WA":
			echo ("document.getElementById(\"ab7\").checked = true;");
			break;
		case "AOT":
			echo ("document.getElementById(\"ab8\").checked = true;");
			break;
		case "NZ":
			echo ("document.getElementById(\"ab9\").checked = true;");
			break;
		case "Australia":
			echo ("document.getElementById(\"ab10\").checked = true;");
			break;
		case "ALL":
			echo ("document.getElementById(\"ab11\").checked = true;");
			break;	
		}	

}

$w_array_l = sizeof($w_user_service_array_2);

$k=0;
for ($k==0;$k<$w_array_l;$k++)
{
	$k1=$k+1;
	$p="p".$k1;	
	$w_u_s = ucfirst($w_user_service_array_2[$k]);
	echo "document.getElementById(\"$p\").value=\"$w_u_s\";";
}
	
echo "</script>";



?>
